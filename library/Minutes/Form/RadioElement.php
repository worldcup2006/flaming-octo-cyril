<?php
namespace Minutes\Form;
class RadioElement extends InputElement
{
    public function __construct($attributes = array()) {
        $attributes['type'] = 'radio';
        parent::__construct($attributes);
    }

    public function setValue($value) {
        if ($this->attributes['value'] == $value) {
            $this->attributes['checked'] = 'checked';
        }
    }
}
