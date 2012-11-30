<?php
namespace Controller;
use Minutes\Application;
use Minutes\Controller;
use Minutes\Session;
use Minutes\Captcha\Kcaptcha;
class CaptchaController extends Controller
{
    public function actionIndex() {
        if (!empty($this->params['sid'])) {
            $captcha = new Kcaptcha();
            Session::setValue($this->params['sid'], $captcha->getKeyString());
        }

    }
}
