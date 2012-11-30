<?php
namespace Minutes\Config;
use Minutes\Config;
class PlainPHP extends Config
{
    public function __construct($fileName) {
        if (!file_exists($fileName)) {
            throw new \Exception('Error loading config file');
        } else {
            $this->config = require_once $fileName;
        }
        //print_r($this->config);
    }

}
