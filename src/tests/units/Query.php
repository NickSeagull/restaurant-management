<?php

namespace Restaurant\tests\units;

require_once __DIR__ . '/../../QueryBuilder.php';

use atoum;

class Query extends atoum
{
    public function testConstructor ()
    {
        $this
            ->given($this->newTestedInstance)
            ->string($this->testedInstance->get())
            ->isEqualTo("");
    }

}