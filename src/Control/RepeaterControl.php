<?php

namespace Theme3\Control;

use App;

class RepeaterControl extends \WP_Customize_Control
{
    public function __construct( $manager, $id, $args = array(), $options = array() )
    {
        parent::__construct( $manager, $id, $args );
        $this->button_label = $args['button_label'];
        $this->view = $args['form'];
    }

    public function enqueue()
    {
        wp_enqueue_script('customizer/main', App\config('T3.assets') . '/scripts/custom/repeater-control.js', array(), null, true);
    }

    public function render_content()
    {
        $data = array( 'form' => $this, 'data' => json_decode($this->value()) );
        echo App\sage('blade')->render('repeater-control', $data);
    }
}
