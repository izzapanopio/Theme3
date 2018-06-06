<?php
namespace Theme3\Customizer;

class Section 
{
    use T3CustomizerTrait;

    public $id;
    public $title;
    public $priority;
    public $controls = [];

    public function __construct($args) 
    {
        $this->id = $this->generateID($args[0]);
        $this->title = $args[0];
        if(!$args[1]) { $this->priority = $args[1]; }
    }

    //public function insertControl
}

