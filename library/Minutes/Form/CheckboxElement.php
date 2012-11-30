<?php
namespace Minutes\Form;
class CheckboxElement extends InputElement
{
    public function __construct($attributes = array()) {
        $attributes['type'] = 'checkbox';
        parent::__construct($attributes);
    }
    public function setValue($value) {
        if ($value) {
            $this->attributes['checked'] = 'checked';
        }
    }
}
