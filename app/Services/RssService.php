<?php

namespace App\Services;

use SimplePie;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Log;

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
        $this->feed->enable_cache(false);  // Disable cache completely
        $this->feed->set_output_encoding('UTF-8');
        $this->feed->strip_htmltags(['img', 'iframe', 'script', 'style']);
        $this->feed->strip_attributes(['style', 'class', 'id']);
        $this->feed->force_feed(true);
        $this->feed->set_timeout(60);  // Increase timeout
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
        try {
            \Log::info('Starting RSS feed fetch');
            
            // Process each feed individually
            $allItems = [];
            foreach ($this->techFeeds as $feedUrl) {
                try {
                    $feed = new SimplePie();
                    $feed->enable_cache(false);
                    $feed->set_feed_url($feedUrl);
                    $feed->set_output_encoding('UTF-8');
                    $feed->force_feed(true);
                    $feed->init();
                    
                    $items = $feed->get_items(0, $limit);
                    if ($items) {
                        $allItems = array_merge($allItems, $items);
                    }
                } catch (\Exception $e) {
                    \Log::warning("Error fetching feed {$feedUrl}: " . $e->getMessage());
                    continue;
                }
            }

            if (empty($allItems)) {
                \Log::warning('No RSS items found in any feed');
                return [];
            }

            \Log::info('Found ' . count($allItems) . ' total items');
            $news = [];
            $seenTitles = [];
            
            foreach ($allItems as $item) {
                try {
                    $title = html_entity_decode($item->get_title(), ENT_QUOTES, 'UTF-8');
                    $title = trim($title);

                    if (in_array($title, $seenTitles)) {
                        continue;
                    }
                    $seenTitles[] = $title;

                    $description = $item->get_description();
                    if (!$description) {
                        $description = $item->get_content();
                    }
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
                    
                    \Log::info("Added news item: {$title}");

                    if (count($news) >= $limit) {
                        break;
                    }
                } catch (\Exception $e) {
                    \Log::error('Error processing RSS item: ' . $e->getMessage());
                    continue;
                }
            }

            usort($news, function($a, $b) {
                return strtotime($b['date']) - strtotime($a['date']);
            });
            
            \Log::info('Returning ' . count($news) . ' news items');
            return $news;
        } catch (\Exception $e) {
            \Log::error('Error in RssService::getNews: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            return [];
        }
    }
}
