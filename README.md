# Theme3 Customizer

A library created for wordpress theme developers to add options for their custom themes based on Sage starter theme.

## Get Started

### Requirements

* Roots / Sage - The theme project should be based on Roots' Sage starter theme.
* Composer

### Installation

You may install the [Customizer](https://github.com/JohnJeevonAng/Theme3) library by including the package on your project as one of its dependencies.

`composer require theme3/customizer:dev-master`

### Sample Usage

~~~php
namespace App;

use Theme3\T3Customizer;

class ThemeCustomizer
{
    const PANEL = 'General';
    public static function render()
    {
    	// create or get the customizer's instance
        $customizer = T3Customizer::getInstance();

        // creating a new panel
        $customizer->create('panel', self::PANEL);

        // creating a new section
        $customizer->create('section', 'Section 1');

        // organizing a section
        $customizer->organize('Section 1', ['App\ThemeCustomizer', 'organize']);

        // render the new components within the customizer
        $customizer->render();
    }

    public static function organize($section)
    {
    	// assigning the section to a panel
    	$section->assign(self::PANEL);

    	// adding new controls 
    	$section->insertControl([
            'id' => 'footer_logo',
            'label' => 'Logo',
            'type' => 'upload'
        ]);
    } 
}
add_action( 'customize_register', [ 'App\ThemeCustomizer', 'render' ] );
~~~
