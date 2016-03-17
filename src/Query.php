<?php

namespace Restaurant;

require_once 'Monad.php';
require_once 'Identity.php';

class Query extends Identity
{

    public function __construct($query = '')
    {
        parent::__construct($query);
    }

}