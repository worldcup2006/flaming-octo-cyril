<?php
namespace Controller;
use Minutes\Controller;
use Minutes\Auth;
use Model\User;
class StaticController extends Controller
{
    public function actionAbout() {
        $this->render('about');
    }
    public function actionContacts() {
        $this->render('contacts');
    }
}
