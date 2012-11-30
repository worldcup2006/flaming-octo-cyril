<?php
namespace Minutes\Validator;
use Minutes\AValidator;
class Numeric extends AValidator
{
    const POSITIVE = 'positive';
    const NOT_ZERO = 'notZero';
    public function isValid($value) {
        if (is_numeric($value)) {
            return true && $this->withParams($value);
        }
        return false;
    }
    protected function positive($value) {
        if ($value >= 0) {
            return true;
        }
        return false;
    }
    protected function notZero($value) {
        if ($value != 0) {
            return true;
        }
        return false;
    }
}
