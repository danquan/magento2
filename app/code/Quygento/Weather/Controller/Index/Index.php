<?php

namespace Quygento\Weather\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\JsonFactory;
use Quygento\Weather\Model\WeatherService;

class Index extends Action {
    protected $pageFactory;
    protected $jsonFactory;
    protected $weatherService;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        JsonFactory $jsonFactory,
        WeatherService $weatherService
    ) {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
        $this->jsonFactory = $jsonFactory;
        $this->weatherService = $weatherService;
    }

    public function execute() {
        // Kiểm tra xem đây có phải là yêu cầu Ajax không
        if ($this->getRequest()->isAjax()) {
            $city = $this->getRequest()->getParam('city', 'Hà Nội'); // Thành phố mặc định là Hà Nội
            $weather = $this->weatherService->getWeatherData($city);

            $result = $this->jsonFactory->create();
            if ($weather) {
                $result->setData([
                    'success' => true,
                    'data' => $weather
                ]);
            } else {
                $result->setData([
                    'success' => false,
                    'message' => 'Unable to fetch weather data. Please check your API key or try another city.'
                ]);
            }
            return $result;
        }

        // Nếu không phải Ajax, trả về giao diện HTML
        return $this->pageFactory->create();
    }
}
