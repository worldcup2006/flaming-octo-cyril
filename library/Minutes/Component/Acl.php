<?php
namespace Minutes\Component;
class Acl extends AbstractComponent
{
    public function init($config) {
        parent::init($config);
    }
    public function checkRights($role, $controller, $action) {
        if (isset($this->config[$role])) {
            if ($this->config[$role] == '*') {
                return true;
            } elseif (isset($this->config[$role][$controller])) {
                if ($this->config[$role][$controller] == '*' || in_array ($action, $this->config[$role][$controller])) {
                    return true;
                }
            }
        }
        return false;
    }
}