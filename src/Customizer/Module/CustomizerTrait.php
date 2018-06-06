<?php
namespace Theme3\Customizer;

trait CustomizerTrait
{

    private function getId($label)
    {
        return sanitize_title($label);
    }
}
