<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Note;
use App\Models\Activity;
use App\Models\Newsletter;
use App\Services\WeatherService;
use App\Services\RssService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    protected $weatherService;
    protected $rssService;

    public function __construct(WeatherService $weatherService, RssService $rssService)
    {
        $this->weatherService = $weatherService;
        $this->rssService = $rssService;
    }

    public function index()
    {
        $data = [
            'stats' => $this->getStats(),
            'activities' => Activity::getRecentActivities(),
            'weather' => $this->getWeatherData(),
            'news' => $this->getNewsData(),
            'charts' => $this->getChartsData(),
        ];

        return view('dashboard', $data);
    }

    protected function getStats()
    {
        return [
            'newsletters' => Newsletter::countThisMonth(),
            'pending_tasks' => Todo::getPendingTasksCount(),
            'pending_today' => Todo::getPendingTasksForToday(),
            'completed_tasks' => Todo::getCompletedTasksThisWeek(),
            'active_notes' => Note::getActiveNotesCount(),
        ];
    }

    protected function getWeatherData()
    {
        try {
            $weather = $this->weatherService->getCurrentWeather();
            Log::info('Weather data received:', ['data' => $weather]);
            return $weather;
        } catch (\Exception $e) {
            Log::error('Error getting weather data: ' . $e->getMessage());
            return null;
        }
    }

    protected function getNewsData()
    {
        try {
            return $this->rssService->getNews();
        } catch (\Exception $e) {
            Log::error('Error fetching news data: ' . $e->getMessage());
            return [];
        }
    }

    protected function getChartsData()
    {
        return [
            'newsletter_stats' => Newsletter::getMonthlyStats(),
            'task_stats' => Todo::getWeeklyCompletedTasks(),
        ];
    }

    public function refreshWeather()
    {
        try {
            Cache::forget('weather_data');
            $weather = $this->weatherService->getCurrentWeather();
            
            if (!$weather) {
                Log::error('No weather data received from service');
                return response()->json(['error' => 'No se pudo obtener la información del clima'], 500);
            }

            Log::info('Weather refresh data:', ['data' => $weather]);
            return response()->json($weather);
        } catch (\Exception $e) {
            Log::error('Error refreshing weather: ' . $e->getMessage());
            return response()->json(['error' => 'No se pudo actualizar la información del clima'], 500);
        }
    }

    public function refreshNews()
    {
        try {
            Cache::forget('rss_news');
            $news = $this->rssService->getNews();
            return response()->json($news);
        } catch (\Exception $e) {
            Log::error('Error refreshing news: ' . $e->getMessage());
            return response()->json(['error' => 'No se pudo actualizar las noticias'], 500);
        }
    }
}
