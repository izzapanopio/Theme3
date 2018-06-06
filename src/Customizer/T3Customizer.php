<?php
namespace Theme3;

use Theme3\Customizer\Collection;

final class T3Customizer 
{
    private static $instance;
    private const PANEL = 'panel';
    private const SECTION = 'section';
    private const CONTROL = 'control'; 
    private $_collection;

    private function __construct() {
        $this->_collection = new Collection;
    }

    private function __clone() {}
    private function __wakep() {}

    public static function getInstance(): T3Customizer
    {
        if(self::$instance === null) {
            self::$instance = new T3Customizer;
        }

        return self::$instance;
    }
    
    public function add(string $type, $args = null): T3Customizer
    {
        switch($type) {
            case self::PANEL:
                $this->_collection->addPanel($args); 
                return $this;
            case self::SECTION:
                $this->_collection->addSection($args);
                return $this;
            case self::CONTROL:
                $this->_collection->control($args);
                return $this;
            default:
                throw new \InvalidArgumentException("$type is not a customizer entity");
        }
    } 
}
