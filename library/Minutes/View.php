<?php
namespace Minutes;
class View
{
    /*
    private $elements;
    
    abstract public function draw();
    
    public function insert($name) {
        if (isset($this->elements[$name])) {
            $this->elements[$name]->drav();
        }
    }
    
    public function add($name, View $view) {
        $this->elements[$name] = $view;
    }
    */
    private $currentMenuItem;
    private $title;
    private $links = array();
    private $meta;
    private $owner;
   
   public function __construct(Controller $owner) {
       $this->owner = $owner;
       $this->currentMenuItem = 'posts';                                        //@HARDcoded
   }
   public function setTitle($title) {
       $this->title = $title;
   }
   public function getTitle() {
       return $this->title;
   }
   public function setCurrentMenuItem($item){
       $this->currentMenuItem = $item;
   }
   public function getCurrentMenuItem(){
       return $this->currentMenuItem;
   }
   public function addLink($attributes = array()) {
       if (is_array($attributes)) {
           $res = '<link ';
           foreach ($attributes as $name => $value) {
               $res .= $name . '="' . $value . '" ';
           }
           $res = ' />';
           $this->links[] = $res;
       } else {
           throw new Exception('Wrong params specified for ' . __METHOD__ . ', array expected');
       }
   }
   public function getLinks() {
       $res = '';
       foreach ($this->links as $link) {
           $res .= $link. PHP_EOL;
       }
       return $res;
   }
}
