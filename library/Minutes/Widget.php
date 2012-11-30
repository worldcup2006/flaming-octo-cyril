<?php
namespace Minutes;
class Widget extends Controller
{
    private $widgetFolder = '_widget';
    protected $widgetView;
    protected $data;
    protected $properties;
    public function __construct($data, $properties = array()) {
        $this->data = $data;
        $this->properties = $properties;
    }
    public function run() {}
    public function renderWidget() {
        $template = $this->resolveFileName($this->widgetView, $this->widgetFolder);
        $this->renderPartial($template, $this->data, false);
    }
}
