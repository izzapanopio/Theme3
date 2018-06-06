<?php
namespace Theme3\Customizer;

use Theme3\Customizer\Panel;

class Collection 
{
    private $_panel = [];
    private $_section = [];

    public function addPanel($args) {
        $this->_panel[] = new Panel( $args );
    } 

    public function addection() {
    }
}
