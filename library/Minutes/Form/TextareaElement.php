<?php
namespace Minutes\Form;
class TextareaElement extends Element
{
    public function render() {
        $val = '';
        $output = '<textarea ';
        foreach ($this->attributes as $name => $value) {
            if ($name == 'value') {
                $val = $value;
                continue;
            }
            $output .= $name . '="' . $value . '" ';
        }
        $output .= '>' . $val . '</textarea>';
        return $output;
    }
}
