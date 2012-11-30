<?php
namespace Minutes;
class View_Layout extends View {
    
    private $layoutPath;
        
    public function __construct($layoutFile = null) {
        $cfg = Application::getInstance()->getConfig();
        $layoutDir = $cfg->getValue('layoutdir') . DIRECTORY_SEPARATOR;
        $fileName = '';
        if (null == $layoutFile) {
            $fileName = $cfg->getValue('layoutfile');
        } else {
            $fileName = $layoutFile;
        }
        $this->layoutPath = $layoutDir . $fileName;
        if (!stream_resolve_include_path($this->layoutPath)) {
            throw new \Exception('Cannot find layout file' . $fileName);
        }
    }
    public function draw() {
        include $this->layoutPath;
    }
}
