<?php
namespace Controller;
use Minutes\Controller;
use Minutes\Auth;
use Model\User;
class AccessController extends Controller
{
    public function actionLogin() {
        if (Auth::getInstance()->isLoggedIn()) {
            $this->redirect($this->createUrl('index', 'index'));
        }
        if ($this->isPost()) {
            //$user = new User();
            if (Auth::getInstance()->login($_POST['login'], $_POST['password'])) {
                $this->redirect($this->createUrl('index', 'index'));
            }
            $this->redirect($this->createUrl('access', 'login'));
        }
        $this->render('login');
    }
    public function actionRegister() {
        $user = new User();
        //$user->addUser('bro', '1111');
    }
    public function actionLogout() {
        if (Auth::getInstance()->isLoggedIn()) {
            Auth::getInstance()->logout();
        }
        $this->redirect($this->createUrl('access', 'login'));
    }
    public function actionDenied() {
        $this->render('denied');
    }
}
