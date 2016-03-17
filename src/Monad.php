<?php

namespace Restaurant;

interface Monad
{
    public function __construct($value);
    public function bind(callable $function);
    public function get();
}