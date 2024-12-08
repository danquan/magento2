<?php

namespace Quygento\Weather\Block;

use \Magento\Framework\View\Element\Template;
use Quygento\Weather\Model\WeatherService;


class Weather extends Template {
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
        "Hà Nội" => ["latitude" => 21.0285, "longitude" => 105.8542], 
        "TP. Hồ Chí Minh" => ["latitude" => 10.8231, "longitude" => 106.6297], 
        "Đà Nẵng" => ["latitude" => 16.0544, "longitude" => 108.2022] 
    ];

    protected $weatherService;

    public function __construct(
        Template\Context $context,
        WeatherService $weatherService,
        array $data = []
    ) {
        $this->weatherService = $weatherService;
        parent::__construct($context, $data);
    }

    public function getWeatherData($city) {
        return $this->weatherService->fetchWeather(
            // $this->cityData[$city]["zip_code"],
            // $this->cityData[$city]["country_code"] 
            $this->cityCoordinates[$city]["latitude"],
            $this->cityCoordinates[$city]["longitude"]
        );
    }

    public function getCities() {
        return array_keys($this->cityCoordinates);
    }
}