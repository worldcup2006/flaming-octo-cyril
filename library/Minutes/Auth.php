<?php
namespace Minutes;
class Auth
{
    const LOGGED_IN = 'loggedIn';
    const STORAGE = 'storage';
    private static $instance = null;
    private $authUserModel;
    private function __construct() { 
        $authUserModel = 'Model\\' . Application::getInstance()->getConfig('authUserModel');
        $class = new $authUserModel();
        if ($class instanceof IAuthUserModel) {
            $this->authUserModel = new $authUserModel;
        } else {
            throw new \Exception('Wrong authUserModel specified');
        }
    }
    private function __clone() {   }
    public static function getInstance() {
        if (null == self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function login($login, $password) {
        $res = $this->authUserModel->checkCredentials($login, $password);
        if ($res) {
            Session::setValue(self::LOGGED_IN, true);
            $this->setStorage($res);
            $this->authUserModel->setSessId($res['id'], Session::getId());  
            return true;
        }
        return false;
    }
    public function logout() {
        $this->authUserModel->setSessId($this->getStorage('id'), null);
        Session::unsetValue(self::LOGGED_IN);
        Session::unsetValue(self::STORAGE);
    }
    public function isLoggedIn() {
        return Session::getValue(self::LOGGED_IN) && $this->authUserModel->checkSessId($this->getStorage('id'), Session::getId());
    }
    public function setStorage($data) {
        Session::setValue(self::STORAGE, $data);
    }
    public function getStorage($valueName = null) {
        $storage = Session::getValue(self::STORAGE);
        if ($valueName) {
            if (isset($storage[$valueName])) {
                return $storage[$valueName];
            } else {
                return null;
            }
        }
        return $storage;
    }
}
