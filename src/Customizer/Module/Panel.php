<?php
namespace Theme3\Customizer;

class Panel implements CustomizerInterface 
{
    use CustomizerTrait;

    public $id;
    public $title;

    public function __construct($args) 
    {
        $this->id = $this->generateID($args[1]);
        $this->title = $args[1];
        if(isset($args[2])) { $this->priority = $args[2]; }
    }
}
