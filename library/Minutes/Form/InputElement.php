<?php
namespace Minutes\Form;
class InputElement extends Element
{
    public function render() {
        $output = '<input ';
        foreach ($this->attributes as $name => $value) {
            $output .= $name . '="' . $value . '" ';
        }
        $output .= '>';
        return $output;
    }
}
