<?php

namespace Quygento\Weather\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    public function getApiKey()
    {
        return $this->scopeConfig->getValue('weather/general/api_key', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
}
