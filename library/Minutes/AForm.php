<?php
namespace Minutes;
abstract class AForm
{
    protected $elements = array();
    protected $atributes;
    
    public function __construct($attributes = array()) {
        if (is_array($attributes)) {
            $this->atributes = $attributes;
        } else {
            throw new \Exception('Wrong attributes specified for Form class');
        }
    }
    public function filter($data) {
        $res = array();
        $prevName = '';                                                         // @refactor for radio element type (continue if $prevName == $name) But  validators must bound to 1st element
        foreach ($this->elements as $element) {
            $value = null;
            $name = $element->getName();
            if ($name == $prevName) {
                continue;
            }
            if (isset($data[$name])) {
                $value = $data[$name];
            }
            $res[$name] = $element->filter($value);
            $prevName = $name;
        }
        return $res;
    }
    public function isValid($data) {
        $res = true;
        $prevName = '';
        foreach ($this->elements as $element) {
            $value = null;
            $name = $element->getName();
            if ($name == $prevName) {
                continue;
            }
            if (isset($data[$name])) {
                $value = $data[$name];
            }
            $valid = $element->validate($value);
            if (!$valid) {
                $element->notValid();
            }
            $res = $res && $valid;
            if (!$res) {
                break;
            }
            $prevName = $name;
        }
        return $res;
    }
    public function populate($data) {
        foreach ($this->elements as $element) {
            $name = $element->getName();
            if (isset($data[$name])) {
                $element->setValue($data[$name]);
            }
        }
    }

    public function startRender() {
        $output = '<form ';
        foreach ($this->atributes as $name => $value) {
            $output .= $name . '="' . $value . '" ';
        }
        $output .= '>';
        return $output;        
    }
    public function endRender() {
        return '</form>';       
    }    
    public function __toString() {
        $output = '<form ';
        foreach ($this->atributes as $name => $value) {
            $output .= $name . '="' . $value . '" ';
        }
        $output .= '>';
        foreach ($this->elements as $element) {
            $output .= $element->render();
        }
        $output .= '</form>';
        return $output;
    }
    
    public function __get($name) {
        if (isset($this->elements[$name])) {
            return $this->elements[$name];
        } 
    }
}
