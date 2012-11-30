<?php
namespace Minutes;
abstract class AFilter
{
    protected $attributes;
    public function __construct($attributes = array()) {
        if (is_array($attributes)) {
            $this->attributes = $attributes;
        } else {
            $this->attributes[] = $attributes;
        }   
    }
    abstract public function filter($value);
}
