<?php

namespace Quygento\HelloWorld\Controller\Hello;

class World extends \Magento\Framework\App\Action\Action {

    public function execute() {
        echo "Hello Quygento";
        exit;   
    }
}
