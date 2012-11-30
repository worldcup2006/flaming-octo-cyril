<?php
namespace Minutes\Component;
use Minutes\IComponent;
abstract class AbstractComponent implements IComponent
{
    protected $config;
    public function init($config) {
        if (is_array($config)) {
            $this->config = $config;
        } else {
            $this->config = $config->getAll();
        }
    }
}
