<?php
namespace Theme3\Customizer;

class Panel
{
    use T3CustomizerTrait;

    public $id;
    public $title;
    public $priority;

    public function __construct($args) 
    {
        $this->id = $this->generateID($args[0]);
        $this->title = $args[0];
        if(!$args[1]) { $this->priority = $args[1]; }
    }

}
