<?php
namespace Theme3\Customizer;

use Theme3\T3Customizer;

class Section implements CustomizerInterface 
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

    public function assign($title) {
        $id = $this->generateId($title);
        $type = T3Customizer::PANEL;
        $panels = Collection::getInstance($type)->data;
        if(!isset($panels[$id])) {
            throw new \InvalidArgumentException("Panel do not exist");
        }
        $this->panel = $id;
        return $this;
    }

    public function insertControl( $args ): self 
    {
        $args['section'] = $this->id;
        Collection::getInstance('control')->add(new Control($args));        
        return $this;
    }

    public function toArray() {
        $arr = [
            'id' => $this->id,
            'title' => $this->title
        ];
        if(isset($this->priority)) { $arr['priority'] = $this->priority; }
        if(isset($this->panel)) { $arr['panel'] = $this->panel; }
        return $arr;
    }
}

