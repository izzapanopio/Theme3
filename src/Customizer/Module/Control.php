<?php
namespace Theme3\Customizer;

class Control implements CustomizerInterface
{
    public $id;
    public $data = [];
    public $setting = [];
    private const SETTINGS_PARAM = [
        'default',
        'transport',
        'capability',
        'theme_supports'
    ];

    public function __construct($args) 
    {
        $this->id = $args['id']; 
        $args['settings'] = $args['id'] . '_setting';
        $this->formatArgs($args);
    }

    private function formatArgs($args) 
    {
        foreach($args as $key => $value) {
            if(in_array($key, self::SETTINGS_PARAM)) {
                $this->setting[$key] = $value;
            } else {
                $this->data[$key] = $value;
            }
        }
    }

    public function getSettings() {
        return $this->setting;
    }

    public function toArray() {
        return $this->data; 
    }
}

