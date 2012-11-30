<?php
namespace Widget;
use Minutes\Widget;
use Minutes\Paginator;
class Pagination extends Widget
{
    public function __construct($data, $properties) {
        parent::__construct($data, $properties);
        $this->widgetView = 'pagination';
    }

    public function run() {
        if (isset($this->properties['paginator']) && ($this->properties['paginator'] instanceof Paginator)) {
            $pg = $this->properties['paginator'];
            $this->data['countPages'] = $pg->getCountPages();
            $this->data['nextPage'] = $pg->getNextPage();
            $this->data['prevPage'] = $pg->getPrevPage();
            $this->data['currPage'] = $pg->getCurrPage();
            if (!isset($this->data['controller'])) {
                $this->data['controller'] = null;
            }
            if (!isset($this->data['action'])) {
                $this->data['action'] = null;
            }
            if (!isset($this->data['route'])) {
                $this->data['route'] = 'default';
            }
        } else {
            throw new \Exception('Wrong paginator specified for widget');
        }
    }
}
