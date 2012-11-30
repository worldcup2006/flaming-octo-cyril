<?php
namespace Minutes;
abstract class Config
{
    protected $config;
    abstract public function __construct($fileName);
    public function getValue($valueName) {
        if(!empty($valueName)) {
            if (is_array($valueName)) {
                return $this->getValueArr($valueName, $this->config);
            } else {
                if (isset($this->config[$valueName])) {
                    return $this->config[$valueName];
                }
            }
        }
        return null;
    }
    public function getAll() {
        return $this->config;
    }

    protected function getValueArr($arr, $targetArr) {
        $current = array_shift($arr);
        if (count($arr) >= 1 && isset($targetArr[$current])) {
            
            return $this->getValueArr($arr, $targetArr[$current]);
        } else {
            if (isset($targetArr[$current])) {
                return $targetArr[$current];
            }
            return null;
        }
    }
}
