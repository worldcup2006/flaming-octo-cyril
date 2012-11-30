<?php
namespace Minutes\Form;
use Minutes\AValidator;
use Minutes\AFilter;
abstract class Element
{
    protected $errorMessage;
    protected $errorClass = 'elementError';
    protected $attributes;
    protected $value;
    protected $filters = array();
    protected $validators = array();

    public function __construct($attributes = array()) {
        if (is_array($attributes)) {
            $this->attributes = $attributes;
        } else {
            throw new \Exception('Wrong attributes specified for Element class');
        }
    }
    abstract public function render();
    public function setValue($value) {
        $this->attributes['value'] = $value;
    }
    public function getName() {
        if (isset($this->attributes['name'])) {
            return $this->attributes['name'];
        }
        return null;
    }
    public function getValue() {
        if (isset($this->attributes['value'])) {
            return $this->attributes['value'];
        }
        return null;
    }   
    public function setName($name) {
        $this->attributes['name'] = $name;
    }
    /*public function setValue($value) {
        $this->attributes['value'] = $value;
    }*/
    public function addFilter(AFilter $filter) {
        $this->filters[] = $filter;
    }
    public function addValidator(AValidator $validator) {
        $this->validators[] = $validator;
    }
    public function notValid() {
        if (isset($this->attributes['class'])){
            $this->attributes['class'] .= ' ' . $this->errorClass;
        } else {
            $this->attributes['class'] = $this->errorClass;
        }
    }
    /*
     * loop through all validators and validate
     * return true/false
     */
    public function validate($value) {
        $res = true;
        foreach ($this->validators as $validator) {
            $res = $res && $validator->isValid($value);
            if(!$res) {
                break;
            }
        }
        return $res;
    }
    public function filter($value) {
        $res = $value;
        foreach ($this->filters as $filter) {
            $res = $filter->filter($res);
        }
        return $res;
    }
    public function __toString() {
        return $this->render();
    }
    public function setErrorMessage($msg) {
        $this->errorMessage = $msg;
    }
    public function getErrorMessage() {
        return $this->errorMessage;
    }
}
