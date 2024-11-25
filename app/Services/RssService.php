<?php

namespace App\Services;

use SimplePie;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class RssService
{
    protected $feed;
    protected $techFeeds = [
        'https://www.xataka.com/index.xml',
        'https://www.genbeta.com/rss.xml',
        'https://es.gizmodo.com/rss',
        'https://www.trecebits.com/feed/',
        'https://computerhoy.com/rss'
    ];

    protected $months = [
        'Jan' => 'Ene', 'Feb' => 'Feb', 'Mar' => 'Mar', 'Apr' => 'Abr',
        'May' => 'May', 'Jun' => 'Jun', 'Jul' => 'Jul', 'Aug' => 'Ago',
        'Sep' => 'Sep', 'Oct' => 'Oct', 'Nov' => 'Nov', 'Dec' => 'Dic'
    ];

    public function __construct()
    {
        $this->feed = new SimplePie();
        $this->feed->set_cache_location(storage_path('app/rss-cache'));
        $this->feed->set_cache_duration(1800); // 30 minutos
        $this->feed->enable_order_by_date(true);
        $this->feed->set_output_encoding('UTF-8');
        $this->feed->strip_htmltags(['img', 'iframe', 'script', 'style']);
        $this->feed->strip_attributes(['style', 'class', 'id']);
        $this->feed->force_feed(true);
        setlocale(LC_TIME, 'es_ES.UTF-8', 'Spanish_Spain.1252');
    }

    protected function formatDate($date)
    {
        try {
            $carbon = Carbon::parse($date);
            $formatted = $carbon->format('j M Y');
            foreach ($this->months as $en => $es) {
                $formatted = str_replace($en, $es, $formatted);
            }
            return $formatted;
        } catch (\Exception $e) {
            return date('j M Y');
        }
    }

    public function getNews($limit = 5)
    {
        Cache::forget('tech_news');
        return Cache::remember('tech_news', 1800, function () use ($limit) {
            $this->feed->set_feed_url($this->techFeeds);
            $this->feed->init();
            
            $news = [];
            $items = $this->feed->get_items(0, $limit * 3);
            $seenTitles = [];
            
            foreach ($items as $item) {
                try {
                    $title = html_entity_decode($item->get_title(), ENT_QUOTES, 'UTF-8');
                    $title = trim($title);

                    // Saltar si ya hemos visto este título
                    if (in_array($title, $seenTitles)) {
                        continue;
                    }
                    $seenTitles[] = $title;

                    $description = $item->get_description();
                    $description = strip_tags($description);
                    $description = html_entity_decode($description, ENT_QUOTES, 'UTF-8');
                    $description = preg_replace('/\s+/', ' ', $description);
                    $description = trim($description);
                    $description = mb_substr($description, 0, 200) . (mb_strlen($description) > 200 ? '...' : '');

                    $source = $item->get_feed()->get_title();
                    $source = html_entity_decode($source, ENT_QUOTES, 'UTF-8');
                    $source = trim($source);

                    $news[] = [
                        'title' => $title,
                        'description' => $description,
                        'link' => $item->get_permalink(),
                        'date' => $this->formatDate($item->get_date('c')),
                        'source' => $source
                    ];
                } catch (\Exception $e) {
                    continue;
                }
            }

            // Ordenar por fecha más reciente
            usort($news, function($a, $b) {
                return strtotime($b['date']) - strtotime($a['date']);
            });
            
            return array_slice($news, 0, $limit);
        });
    }
}
