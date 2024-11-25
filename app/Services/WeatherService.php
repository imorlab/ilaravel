<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class WeatherService
{
    protected $baseUrl;
    protected $apiKey;
    
    public function __construct()
    {
        $this->baseUrl = config('services.weather.base_url');
        $this->apiKey = config('services.weather.key');
        
        Log::info('WeatherService initialized', [
            'baseUrl' => $this->baseUrl,
            'apiKey' => $this->apiKey
        ]);
    }

    public function getCurrentWeather($city = 'Sevilla')
    {
        Cache::forget('weather_data'); // Forzar nueva petición
        
        try {
            $url = "{$this->baseUrl}/current.json";
            $params = [
                'key' => $this->apiKey,
                'q' => $city,
                'aqi' => 'no'
            ];

            Log::info('Making weather API request', [
                'url' => $url,
                'params' => $params
            ]);

            // Hacer la petición sin usar el cliente HTTP de Laravel para más control
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url . '?' . http_build_query($params));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $error = curl_error($ch);
            
            Log::info('CURL response', [
                'response' => $response,
                'httpCode' => $httpCode,
                'error' => $error
            ]);

            curl_close($ch);

            if ($error) {
                Log::error('CURL error', ['error' => $error]);
                return null;
            }

            if ($httpCode !== 200) {
                Log::error('API error', [
                    'httpCode' => $httpCode,
                    'response' => $response
                ]);
                return null;
            }

            $data = json_decode($response, true);
            
            if (!isset($data['current'])) {
                Log::error('Invalid API response', ['data' => $data]);
                return null;
            }

            $weatherData = [
                'temp_c' => $data['current']['temp_c'],
                'condition' => $data['current']['condition']['text'],
                'icon' => 'https:' . $data['current']['condition']['icon'],
                'humidity' => $data['current']['humidity'],
                'wind_kph' => $data['current']['wind_kph']
            ];

            Log::info('Weather data processed successfully', $weatherData);
            return $weatherData;

        } catch (\Exception $e) {
            Log::error('Exception in getCurrentWeather', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return null;
        }
    }
}
