<?php

namespace Quygento\Weather\Model;

use Quygento\Weather\Helper\Data;

class WeatherService {
    // protected $cityData = [ 
    //     "Tokyo" => ["zip_code" => "100-0001", "country_code" => "JP"], 
    //     "Seoul" => ["zip_code" => "04524", "country_code" => "KR"], 
    //     "London" => ["zip_code" => "EC1A 1BB", "country_code" => "GB"], 
    //     "Paris" => ["zip_code" => "75001", "country_code" => "FR"], 
    //     "New York" => ["zip_code" => "10001", "country_code" => "US"], 
    //     "Washington" => ["zip_code" => "20001", "country_code" => "US"], 
    //     "Melbourne" => ["zip_code" => "3000", "country_code" => "AU"], 
    //     "Beijing" => ["zip_code" => "100000", "country_code" => "CN"], 
    //     "Hà Nội" => ["zip_code" => "100000", "country_code" => "VN"], 
    //     "TP. Hồ Chí Minh" => ["zip_code" => "700000", "country_code" => "VN"], 
    //     "Đà Nẵng" => ["zip_code" => "550000", "country_code" => "VN"] 
    // ];

    protected $cityCoordinates = [ 
        "Tokyo" => ["latitude" => 35.6895, "longitude" => 139.6917], 
        "Seoul" => ["latitude" => 37.5665, "longitude" => 126.9780], 
        "London" => ["latitude" => 51.5074, "longitude" => -0.1278], 
        "Paris" => ["latitude" => 48.8566, "longitude" => 2.3522], 
        "New York" => ["latitude" => 40.7128, "longitude" => -74.0060], 
        "Washington" => ["latitude" => 38.9072, "longitude" => -77.0369], 
        "Melbourne" => ["latitude" => -37.8136, "longitude" => 144.9631], 
        "Hong Kong" => ["latitude" => 22.3193, "longitude" => 114.1694], 
        "Beijing" => ["latitude" => 39.9042, "longitude" => 116.4074], 
        "Hà Nội" => ["latitude" => 21.0287, "longitude" => 105.8521], 
        "TP. Hồ Chí Minh" => ["latitude" => 10.8231, "longitude" => 106.6297], 
        "Đà Nẵng" => ["latitude" => 16.0544, "longitude" => 108.2022] 
    ];

    protected $helper;

    public function __construct(Data $helper) {
        $this->helper = $helper;
    }
    
    public function getCities() {
        return array_keys($this->cityCoordinates);
    }

    // public function fetchWeather($city) {
    //     $apiKey = $this->helper->getApiKey();
    //     $url = "http://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";

     
    //     $response = file_get_contents($url);
    //     return json_decode($response, true);
    // }

    protected function fetchLocation($zip_code, $country_code) {
        $apiKey = $this->helper->getApiKey();
        $url = "http://api.openweathermap.org/geo/1.0/zip?zip={$zip_code},{$country_code}&limit=1&appid={$apiKey}";
     
        $response = file_get_contents($url);
        return json_decode($response, true);
    }

    public function fetchWeather($lat, $lon) {
        try {
        $apiKey = $this->helper->getApiKey();
        $url = "https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&appid={$apiKey}";
        $response = file_get_contents($url);
        return json_decode($response, true);
        } catch (\Exception $e) {
            throw new LocalizedException(__('Unable to fetch weather data.'));
        }

        return null;
    }
    
    public function getWeatherData($city) {
        return $this->fetchWeather(
            // $this->cityData[$city]["zip_code"],
            // $this->cityData[$city]["country_code"] 
            $this->cityCoordinates[$city]["latitude"],
            $this->cityCoordinates[$city]["longitude"]
        );
    }
}