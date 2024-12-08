<?php

namespace Quygento\Weather\Controller\Weather;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

use Quygento\Weather\Model\WeatherService;

class World extends \Magento\Framework\App\Action\Action {

    public function execute() {
        $city = $this->getRequest()->getPost('city', 'Hà Nội'); 
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getLayout()->getBlock('quygento_weather_block')->setData('city', $city);
        return $resultPage;
    }
}
