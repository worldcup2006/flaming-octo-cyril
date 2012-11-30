<?php
namespace Minutes\Component;
use Minutes\IComponent;
use Minutes\Route;
class Routing extends AbstractComponent implements IComponent
{
    private $routes = array();
    public function init($config) {
        parent::init($config);
        foreach ($this->config as $key => $val) {
            $this->routes[$key] = new Route($key, $val['pattern'], $val['defaults']);
        }
        $this->routes['default'] = new Route();
    }
    public function chooseRoute($request) {
        foreach ($this->routes as $route) {
            if ($route->match($request)) {
                //echo 'Route chosen: ' . $route->name;
                return $route->dispatch($request);
            }
        }
    }
    public function getRoute($name) {
        if (isset($this->routes[$name])) {
            return $this->routes[$name];
        }
        return false;
    }
}
