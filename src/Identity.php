<?php

namespace Restaurant;

require_once 'Monad.php';

class Identity extends Monad
{

    public function __construct($value = '')
    {
        $this->value = $value;
    }

    public function bind(callable $function)
    {
        return new Identity($function($this->value));
    }

    public function get()
    {
        return $this->value;
    }

}