<?php
namespace Minutes\Filter;
use Minutes\AFilter;
class Bool extends AFilter
{
    public function filter($value) {
        // filter fo check boxes
        if ($value) {
            return true;
        }
        return false;
    }
}
