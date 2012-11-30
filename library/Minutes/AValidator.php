<?php
namespace Minutes;
abstract class AValidator
{
    protected $params;
    protected $attributes;
    public function __construct($params = array(), $attributes = array()) {
        if (is_array($params)) {
            $this->params = $params;
        } else {
            $this->params[] = $params;
        }
        if (is_array($attributes)) {
            $this->attributes = $attributes;
        } else {
            $this->attributes[] = $attributes;
        }    
    }
    protected function withParams($value) {
        $res = true;
        foreach ($this->params as $callable) {
            if (is_callable(array($this, $callable), true)) {
                $res = $res && $this->$callable($value);
            } else {
                throw new \Exception('Invalid parameter supplied for vaildator');
            }
            if (!$res) {
                break;
            }
        }
        return $res;
    }
    abstract public function isValid($value);
}
