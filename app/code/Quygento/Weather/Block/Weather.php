<?php

namespace Quygento\Weather\Block;

use \Magento\Framework\View\Element\Template;
use Quygento\Weather\Model\WeatherService;


class Weather extends Template {
    protected $weatherService;

    public function __construct(
        Template\Context $context,
        WeatherService $weatherService,
        array $data = []
    ) {
        $this->weatherService = $weatherService;
        parent::__construct($context, $data);
    }

    /**
     * Lấy URL cho Ajax
     */
    public function getAjaxUrl() {
        return $this->getUrl('weather'); // URL cho Ajax
    }


    public function getCities() {
        return $this->weatherService->getCities();
    }
}