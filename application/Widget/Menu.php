<?php
namespace Widget;
use Minutes\Widget;
use Minutes\View;
class Menu extends Widget
{
    public function __construct($data, $properties) {
        parent::__construct($data, $properties);
        $this->widgetView = 'menu';
    }

    public function run() {
        /*if (isset($this->properties['view']) && ($this->properties['view'] instanceof View)) {
            $v = $this->properties['view'];
            $this->data['current'] = $v->getCurrentMenuItem();
        } else {
            throw new \Exception('Wrong paginator specified for widget');
        }*/
    }
}
