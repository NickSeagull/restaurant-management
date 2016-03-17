<?php

namespace Restaurant;

require_once 'Monad.php';

class QueryBuilder implements Monad
{

    public function __construct($query = "")
    {
        $this->query = $query;
    }

    public function get()
    {
        return $this->query;
    }

    public function bind(callable $function){
        return NULL;
    }

}