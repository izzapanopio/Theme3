<?php
namespace Theme3\Customizer;

class Section implements CustomizerInterface 
{
    use CustomizerTrait;

    public $id;
    public $title;
    public $priority;
    public $controls = [];

    public function __construct($args) 
    {
        $this->id = $this->generateID($args[1]);
        $this->title = $args[1];
        if(isset($args[2])) { $this->priority = $args[2]; }
    }

    //public function insertControl
}

