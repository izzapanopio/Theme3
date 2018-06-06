<?php
namespace Theme3\Customizer;

trait T3CustomizerTrait
{

    private function generateId($label)
    {
        return sanitize_title($label);
    }

}

