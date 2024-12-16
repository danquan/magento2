<?php

namespace Quygento\Weather\Model;

use Quygento\Weather\Helper\Data;

class WeatherService {
    protected $helper;

    public function __construct(Data $helper) {
        $this->helper = $helper;
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
        $apiKey = $this->helper->getApiKey();
        $url = "https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&appid={$apiKey}&units=metric";
     
        $response = file_get_contents($url);
        return json_decode($response, true);
    }
}