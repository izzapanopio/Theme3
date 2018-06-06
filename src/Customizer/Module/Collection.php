<?php
namespace Theme3\Customizer;

class Collection 
{
    private static $instances = [];
    public $data = [];

    private function __construct() {}
    private function __clone() {}
    private function __wakeup() {}

    public static function getInstance(string $instanceName): self 
    {
       if(!array_key_exists($instanceName, self::$instances)) { 
            self::$instances[$instanceName] = new self();
        }

        return self::$instances[$instanceName];
    }

    public function add(CustomizerInterface $obj): void
    {
        $this->data[$obj->id] = $obj;
    }

    public function get($id) 
    {
        return $this->data[$id];
    }
    //public function addPanel(string $title, int $priority) {
    //    $this->_panel[] = new Panel(func_get_args());
    //} 

    //public function addSection(string $title, int $priority) {
    //    $this->_section[] = new Section(func_get_args());    
    //}

    
}
