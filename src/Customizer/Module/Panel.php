<?php
namespace Theme3\Customizer;

use Theme3\Customizer\Collection;
use Theme3\Customizer\CustomizerTrait;

class Panel extends Collection
{
    use CustomizerTrait;

    public $id;

    public function __construct( $args ) 
    {
        $this->id = $args;
    }

}
