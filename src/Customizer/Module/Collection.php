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
        if(!isset($this->data[$id]))
            throw new \InvalidArgumentException("$id do not exist");
        return $this->data[$id];
    }
}
