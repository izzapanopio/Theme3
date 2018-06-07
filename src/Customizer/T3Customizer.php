<?php
namespace Theme3;

use App;
use Theme3\Customizer\Collection;
use Theme3\Customizer\Panel;
use Theme3\Customizer\Section;
use Theme3\Customizer\CustomizerTrait;

final class T3Customizer
{
    use CustomizerTrait;
    private static $instance;

    public const PANEL = 'panel';
    public const SECTION = 'section';
    public const CONTROL = 'control';
    public const ENTITIES = [
        'panel',
        'section',
        'control'
    ];

    public $controls = [
        'color' => '\WP_Customize_Color_Control',
        'image' => '\WP_Customize_Image_Control',
        'upload' => '\WP_Customize_Upload_Control',
        'repeater' => 'Theme3\Control\RepeaterControl'
    ];

    private function __construct()
    {
        $config = [
            'T3.assets' => App\config('theme.uri') . '/vendor/Theme3/assets'
        ];

        App\config($config);
    }

    private function __clone() {}
    private function __wakeup() {}

    public static function getInstance(): self
    {
        if(self::$instance === null) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function removeDefaults()
    {
        global $wp_customize;
        $sections = [
            'title_tagline',
            'static_front_page',
            'widgets'
        ];

        foreach($sections as $section) {
            $wp_customize->remove_section($section);
        }

        return $this;
    }

    public function create(string $type, string $title, int $priority = 0): T3Customizer
    {
        switch($type) {
            case self::PANEL:
                Collection::getInstance($type)->add(new Panel(func_get_args()));
                return $this;
            case self::SECTION:
                Collection::getInstance($type)->add(new Section(func_get_args()));
                return $this;
            default:
                throw new \InvalidArgumentException("$type is not a customizer entity");
        }
    }

    public function getSection($title)
    {
        return Collection::getInstance(self::SECTION)->get($this->generateId($title));
    }

    public function render() {
        global $wp_customize;
        $this->wp_customize = $wp_customize;
        foreach(self::ENTITIES as $type) {
            $args = Collection::getInstance($type)->data;
            if($type == self::CONTROL) {
                $this->renderControl($type);
            } else if($type == self::SECTION) {
                $this->renderSection($type);
            } else {
                $this->renderPanel($type);
            }
        }
    }

    private function renderPanel($type) {
        $panels = Collection::getInstance($type)->data;
        foreach($panels as $panel) {
            $this->wp_customize->add_panel($panel->id, $panel->toArray());
        }
    }

    private function renderSection($type) {
        $sections = Collection::getInstance($type)->data;
        foreach($sections as $section) {
            $this->wp_customize->add_section($section->id, $section->toArray());
        }
    }

    private function getControlClass($type) {
        if(!isset($this->controls[$type])) {
            return '\WP_Customize_Control';
        }
        return $this->controls[$type];
    }

    private function renderControl($type) {
        $controls = Collection::getInstance($type)->data;
        foreach($controls as $control) {
            $args = $control->toArray();
            $this->wp_customize->add_setting($args['settings'], $control->getSettings());
            $type = isset($args['type'])?$args['type']:'';
            $Class = $this->getControlClass($type);
            $this->wp_customize->add_control(new $Class(
                $this->wp_customize,
                $control->id,
                $args
            ));
        }
    }

    public function organize(string $title, callable $func) {
        $func($this->getSection($title));
    }
}
