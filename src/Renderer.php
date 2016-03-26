<?php

class Renderer {

    public function render_navbar($raw_navbar){
        $result = "<ul>";
        foreach ($raw_navbar as $key => $value){
            $result = "$result<li><a href=\"$value\">$key</a></li>";
        }
        $result = $result . "</ul>";
        return $result;
    }
}

$renderer = new Renderer();