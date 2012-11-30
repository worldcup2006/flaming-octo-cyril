<?php
namespace Minutes\Filter;
use Minutes\AFilter;
class Trim extends AFilter
{
    public function filter($value) {
        if (isset($this->attributes['charlist'])) {
            return trim($value, $this->attributes['charlist']);
        }
        return trim($value);
    }
}
