<?php
namespace Theme3;

use Theme3\Customizer\Collection;
use Theme3\Customizer\Panel;
use Theme3\Customizer\Section;

final class T3Customizer 
{
    private static $instance;

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
    
    public function create(string $type, string $title, int $priority = 0): T3Customizer
    {
        switch($type) {
            case self::PANEL:
                Collection::getInstance($type)->add(new Panel(func_get_args()));
                return $this;
            case self::SECTION:
                Collection::getInstance($type)->add(new Section(func_get_args()));
                return $this;
            default:
                throw new \InvalidArgumentException("$type is not a customizer entity");
        }
    } 

    public function render() {
        echo "<pre>";
        var_dump( Collection::getInstance('panel') );
        echo "</pre>";
    }
}
