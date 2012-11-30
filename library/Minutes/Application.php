<?php
namespace Minutes;
use Minutes\IComponent;
class Application
{
    private static $instance = null;
    private $config;
    private $components;

    private function __construct() {   }
    private function __clone() {   }
    
    public function run(Config $config) {
        $this->config = $config;
        $this->initComponents();
        $this->dispatch($_SERVER['REQUEST_URI']);
    }
    private function initComponents() {
        $prefix = 'Minutes\Component\\';
        foreach ($this->config->getValue('components') as $componentName => $componentParams) {
            $className = $prefix . ucfirst($componentName);
            $class = new $className();
            if (!($class instanceof IComponent)) {
                throw new \Exception('Class ' . $className . ' should implement IComponent interface');
            }
            $this->components[$componentName] = $class;
            if (!is_array($componentParams)) {
                if (stream_resolve_include_path($componentParams)) {
                    $componentParams = new Config\PlainPHP($componentParams);
                } else {
                    throw new \Exception('Error loading ' . $className . ' component config');
                }
            }
            $this->components[$componentName]->init($componentParams);
        }
    }
    private function dispatch($request) {
        $router = $this->components['routing'];
        $requestParams = $router->chooseRoute(urldecode($request));
        $controllerName = $requestParams['controller'];
        $actionName = $requestParams['action'];

        $controller = 'Controller\\' . ucfirst($controllerName) . 'Controller';
        $action = 'action' . $actionName;
        if (!class_exists($controller)) {
            $this->notFound();
        }
        $instance = new $controller($requestParams);
        if ($instance instanceof Controller) {            
            if(method_exists($instance, $action)){
                //check config for auth==true
                //then call smth like $this->auth
                if ($this->getConfig('auth')) {
                    $this->auth($instance, $action, $controllerName, $actionName);
                } else {
                    $instance->$action();
                }
            } else {
                $this->notFound();
                //throw new \Exception('Cannot find action ' . $action);
            }
        } else {
            $this->notFound();
            //throw new \Exception('Class ' . $controller . ' should extend Component class');
        }
    }
    private function auth($instance, $action, $controllerName, $actionName) {
        //check user status if not logged in status=guest
        //check $instance acl if fails call $instance->unautorizied();
        $role = 'guest';
        if (Auth::getInstance()->isLoggedIn()) {
            $user = Auth::getInstance()->getStorage();
            $role = $user['role'];
        }
        if ($acl = $this->getComponent('acl')) {
            if ($acl->checkRights($role, $controllerName, $actionName)) {
                $instance->$action();
            } else {
                $instance->_unauthorized();
            }
        } else {
            throw new \Exception('Acl component not defined');
        }
        /*
         *             if (isset ($this->components['acl'])) {
                $user = Auth::getInstance()->getStorage();
                if ($this->components['acl']->checkRights($user['role'], $controllerName, $actionName)) {
                    $instance->$action();
                    return;
                }
            }
         */
    }
    public function notFound() {
        /*$controller = $this->getConfig('errorController');
        $action = $this->getConfig('notFoundAction');
        if (!$controller || !$action) {
            require 'Minutes/Html/notfound.html';
            exit;
        }
        $front = new Controller();
        $front->redirect($front->createUrl($controller, $action));
         */
        $front = new Controller();
        $front->notFound();
    }


    public function getConfig($valueName = null) {
        if ($valueName === null) {
            return $this->config;
        }
        return $this->config->getValue($valueName);
    }
    public function getComponent($componentName) {
        if (isset($this->components[$componentName])) {
            return $this->components[$componentName];
        }
        return false;
    }
    public function getDb() {
        return $this->components['db']->getAdapter();
    }
    public static function getInstance() {
        if (null == self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
