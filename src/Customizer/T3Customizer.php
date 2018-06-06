<?php
namespace Theme3;

use Theme3\Customizer\Collection;

final class T3Customizer 
{
    private static $instance;
    private $_collection;

    private const PANEL = 'panel';
    private const SECTION = 'section';
    private const CONTROL = 'control'; 

    private function __construct() {}
    private function __clone() {}
    private function __wakep() {}

    public static function getInstance(): self
    {
        if(self::$instance === null) {
            self::$instance = new self;
        }

        return self::$instance;
    }
    
    public function create(string $type, $title, int $priority = 0): T3Customizer
    {
        switch($type) {
            case self::PANEL:
                $this->_collection->addPanel($title, $priority); 
                return $this;
            case self::SECTION:
                $this->_collection->addSection($title, $priority);
                return $this;
            case self::CONTROL:
                $this->_collection->control($args);
                return $this;
            default:
                throw new \InvalidArgumentException("$type is not a customizer entity");
        }
    } 

    public function render() {
        echo "<pre>";
        var_dump( $this->_collection );
        echo "</pre>";
    }
}
