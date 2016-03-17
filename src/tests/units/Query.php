<?php

namespace Restaurant\tests\units;

require_once __DIR__ . '/../../Query.php';

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

    public function testBind ()
    {
        $this
            ->given($this->newTestedInstance)
            ->and($newQuery = $this
                  ->testedInstance
                  ->bind(function($q){
                      return $q . "Test";
                  }))
            ->string($newQuery->get())
            ->isEqualTo("Test");
    }

}