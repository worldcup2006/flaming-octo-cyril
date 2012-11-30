<?php
namespace Minutes\Component;
use Minutes\IComponent;
class Db extends AbstractComponent implements IComponent
{

    private $adapter;


    public function init($config) {
        parent::init($config);
        $this->adapter = $this->factory($config);
    }
    
    private function factory($config) {
        $className = '\\Minutes\\Db\\';
        switch ($config['adapter']) {
            case 'mysql':
                $className .= 'Mysql';
                break;

            default:
                throw new \Exception('Cant find db adapter ' . $adapterName);
        }
        return new $className($config);
    }
    public function getAdapter() {
        return $this->adapter;
    }
}
