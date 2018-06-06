<?php
namespace Theme3\Customizer;

class Collection 
{
    private static $instances = [];
    private $data = [];

    private function __construct() {}
    private function __clone() {}
    private function __wakeup() {}

    public static function getInstance(string $instanceName): self 
    {
        if($instances[$instanceName] === null) {
            self::$instaces[$instanceName] = new self;
        }

        return $instances[$instanceName];
    }

    //public function addPanel(string $title, int $priority) {
    //    $this->_panel[] = new Panel(func_get_args());
    //} 

    //public function addSection(string $title, int $priority) {
    //    $this->_section[] = new Section(func_get_args());    
    //}

    
}
