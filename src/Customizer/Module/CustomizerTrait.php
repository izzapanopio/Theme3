<?php
namespace Theme3\Customizer;

trait CustomizerTrait
{

    private function generateId($label)
    {
        return sanitize_title($label);
    }

}

