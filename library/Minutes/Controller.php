<?php
namespace Minutes;
class Controller
{
    protected $params = array();
    protected $response;
    protected $view;
    private $viewFolder = 'view';
    private $layoutFolder = '_layout';
    private $layoutFile = 'default';
    private $controllerName;
    private $actionName;                                                        //@questionable

    public function __construct($params = array()) {
        if (isset($params['controller'])) $this->controllerName = $params['controller'];
        if (isset($params['action'])) $this->actionName = $params['action'];                                  //@questionable
        foreach ($params as $name => $param) {
            if ($name != 'controller' && $name != 'action') {
                $this->params[$name] = $param;
            }            
        }
        $this->response = new Response();
        $this->view = new View($this);
        //default settings
        if($viewFolder = Application::getInstance()->getConfig('viewFolder')) {
            $this->viewFolder = $viewFolder;
        }
        if($layoutFolder = Application::getInstance()->getConfig('layoutFolder')) {
            $this->layoutFolder = $layoutFolder;
        }
        if($layoutFile = Application::getInstance()->getConfig('layoutFile')) {
            $this->layoutFile = $layoutFile;
        }
    }
    
    public function isPost() {
        return strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') ? false : true;
    }


    public function render($template, $data = array(), $rawReturn = false) {
        $file = $template;
        if (!stream_resolve_include_path($file)) {
            $file = $this->resolveFileName($template, $this->controllerName);
        }
        $output = $this->renderPartial($file, $data);
        if (false !== $layout = $this->resolveFileName($this->layoutFile, $this->layoutFolder)) {
            $output = $this->renderPartial($layout, array('content' => $output));
        }
        if ($rawReturn) {
            return $output;
        }        
        $this->response->setBody($output);        
        $this->response->send();
    }
    
    public function redirect($url) {
        if (!headers_sent()) {
            session_write_close();
            header('Location: ' . $url);
            exit();
        } else {
            throw new \Exception('Headers already sent!');
        }
    }
    
    public function notFound() {
        $controller = Application::getInstance()->getConfig('errorController');
        $action = Application::getInstance()->getConfig('notFoundAction');
        if (!$controller || !$action) {
            require 'Minutes/Html/notfound.html';
            exit;
        }
        $this->redirect($this->createUrl($controller, $action));
    }
    
    protected function renderPartial($template, $data = array(), $return = true) {
        if (false !== $template) {
            extract($data, EXTR_PREFIX_SAME, 'data');
            if ($return) {
                ob_start();
                //ob_implicit_flush(false);
                require($template);
                return ob_get_clean();
            } else {
                require($template);
            }
        } else {
            throw new \Exception('Cannot load template file ' . $template);
        }
        
    }
    
    protected function resolveFileName($name, $subFolder = '') {
        $relativePath = '';
        if ($subFolder) {
            $subFolder .= DS;
        }
        if (strripos($name, '.')) {
        //TODO handle paths like 'folder.anotherfolder.filename'   
        } else {
            $relativePath = $this->viewFolder . DS . $subFolder . $name . '.php';
            if (stream_resolve_include_path($relativePath)) {
                return $relativePath;
            } else {
                return false;
            }
        }        
    }
    public function createUrl($controller, $action, $params = array(), $routeName = 'default') {
        $routing = Application::getInstance()->getComponent('routing');
        if (!$route = $routing->getRoute($routeName)) {
            throw new \Exception('Cant find route ' . $routeName);
        }
        if ($controller) {
            $params['controller'] = $controller;
        }
        if ($action) {
            $params['action'] = $action;
        }
        return 'http://' . $_SERVER['SERVER_NAME'] . $route->reverse($params);
    }
    public function baseUrl(){
        return 'http://' . $_SERVER['SERVER_NAME'];
    }
    public function widget($class, $data = array(), $properties = array()) {
        $className = '\\Widget\\' . $class;
        $widget = new $className($data, $properties);
        if ($widget instanceof Widget) {
            $widget->run();
            $widget->renderWidget();
        } else {
            throw new \Exception('Widget ' . $class . 'must extend Widget class');
        }
    }
    public function _unauthorized() {
        $this->redirect($this->createUrl('access', 'denied'));
    }
    public function escape($value){
        return htmlspecialchars($value);
    }
}
