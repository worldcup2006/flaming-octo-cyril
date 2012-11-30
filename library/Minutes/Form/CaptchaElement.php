<?php
namespace Minutes\Form;
class CaptchaElement extends Element {
    public function render() {
        $output = '<img ';
        foreach ($this->attributes as $name => $value) {
            if ($name == 'src') {
                $value .= '/sid/' . md5($_SERVER['REQUEST_URI']);
            }
            $output .= $name . '="' . $value . '" ';
        }
        $output .= ' />';
        //src="' . $this->attributes['imgSrc'] . '/sid/' . md5($_SERVER['REQUEST_URI']) . '"/>';
        //$output .= '<input type="hidden" value="' . md5($_SERVER['REQUEST_URI']) . '"/>';
        return $output;
    }
    public function setValue($value) {
        
    }
}
