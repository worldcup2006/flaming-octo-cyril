<?php
namespace Minutes\Validator;
use Minutes\AValidator;
class NotEmpty extends AValidator
{
    public function isValid($value) {
        if (null !== $value && '' !== $value) {
            return true;
        }
        return false;
    }
}
