<?php

namespace Restaurant;

abstract class Monad
{
    abstract public function __construct($value);
    abstract public function bind(callable $function);
    abstract public function get();
}