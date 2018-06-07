<?php
namespace Theme3\Control; 

use App;

class RadioImageControl extends \WP_Customize_Control
{

    public $type = 'radio_image';
    private $form;

    public function __construct($manager, $id, $args) 
    {
        parent::__construct( $manager, $id, $args );
        $this->form = json_decode(json_encode($args), FALSE);
    }
        
    public function enqueue() 
    {
        wp_enqueue_style('radio_image_css', App\Config('T3.assets') . '/styles/radio-image.css' );
        wp_enqueue_script('radio_image_js', App\Config('T3.assets') . '/scripts/custom/radio-image.js' );
    }
    
    public function render_content() 
    { 
        if( !isset($this->form->choices) || !count($this->form->choices) ) {
            return;
        }
        echo App\sage('blade')->render('radio-image-control', ['form'=>$this->form]);    
    }
}
