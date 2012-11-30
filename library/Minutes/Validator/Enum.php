<?php
namespace Minutes\Validator;
use Minutes\AValidator;
//need $this->attributes['enum'] as array
class Enum extends AValidator
{
    public function isValid($value) {
        if (isset($this->attributes['enum'])) {
            if (is_array($this->attributes['enum'])) {
                if (!in_array($value, $this->attributes['enum'])) {
                    return false;
                }
            }
        }
        return true;
    }
}
