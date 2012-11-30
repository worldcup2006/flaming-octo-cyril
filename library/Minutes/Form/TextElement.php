<?php
namespace Minutes\Form;
class TextElement extends InputElement
{
    public function __construct($attributes = array()) {
        $attributes['type'] = 'text';
        parent::__construct($attributes);
    }
}
