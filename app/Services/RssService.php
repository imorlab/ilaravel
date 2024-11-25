<?php

namespace App\Services;

use SimplePie;
use Illuminate\Support\Facades\Cache;

class RssService
{
    protected $feed;

    public function __construct()
    {
        $this->feed = new SimplePie();
        $this->feed->set_cache_location(storage_path('app/rss-cache'));
        $this->feed->set_cache_duration(1800); // 30 minutos
    }

    public function getNews($feedUrl = 'https://feeds.elpais.com/mrss-s/pages/ep/site/elpais.com/portada', $limit = 5)
    {
        return Cache::remember('rss_news', 1800, function () use ($feedUrl, $limit) {
            $this->feed->set_feed_url($feedUrl);
            $this->feed->init();
            
            $news = [];
            $items = $this->feed->get_items(0, $limit);
            
            foreach ($items as $item) {
                $news[] = [
                    'title' => $item->get_title(),
                    'description' => $item->get_description(),
                    'link' => $item->get_permalink(),
                    'date' => $item->get_date('j M Y'),
                    'source' => $item->get_source() ? $item->get_source()->get_title() : 'El País'
                ];
            }
            
            return $news;
        });
    }
}
