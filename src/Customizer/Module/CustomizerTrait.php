<?php
namespace Theme3\Customizer;

trait CustomizerTrait
{
    private function generateId(string $label)
    {
        return sanitize_title($label);
    }

    //private function setArray(array $items, array &$response) {
    //    foreach($items as $item) {
    //        if(isset($this->$item)) {
    //            $response[$item] = $this->$item;
    //        }
    //    }
    //}

    public function toArray() {
        return get_object_vars($this);
    }

}

