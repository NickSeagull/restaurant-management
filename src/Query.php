<?php

namespace Restaurant;

require_once 'Monad.php';

class Query implements Monad
{

    public function __construct($query = '')
    {
        $this->query = $query;
    }

    public function bind(callable $function)
    {
        return new Query($function($this->query));
    }

    public function get()
    {
        return $this->query;
    }

}