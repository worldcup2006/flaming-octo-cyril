<?php
namespace Minutes\Validator;
use Minutes\AValidator;
use Minutes\Session;
use Minutes\Handler;
class Captcha extends AValidator
{
    public function isValid($value) {
        $sid = md5($_SERVER['REQUEST_URI']);
        $keyword = Session::getValue($sid);
        Session::unsetValue($sid);
        Handler::log($keyword);
        Handler::log($sid);
        if ($keyword && $keyword == $value) {
            return true;
        }
        return false;
    }
}
