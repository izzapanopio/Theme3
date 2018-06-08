<?php

namespace Theme3\Control;

use App;

class RepeaterControl extends \WP_Customize_Control
{
    public function __construct( $manager, $id, $args = array(), $options = array() )
    {
        parent::__construct( $manager, $id, $args );
        $this->options = json_decode(json_encode($args['options']));
        if(!isset($this->options->type)) {
            $this->options->type = 'dynamic';
        }
    }

    public function enqueue()
    {
        wp_enqueue_style('customizer/main', App\config('T3.assets') . '/styles/control/repeater-control.css', null, false);
        wp_enqueue_script('customizer/main', App\config('T3.assets') . '/scripts/control/repeater-control.js', array(), null, true);
    }

    public function render_content()
    {
        $value = json_decode($this->value());

        if($this->options->type == 'fixed' && count($value) != $this->options->count) {
            $value = array_fill(0, 4, []);
        }

        $data = array( 'form' => $this, 'data' => $value );
        echo App\sage('blade')->render('repeater-control', $data);
    }
}
