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

    public function render_content($content_filename){
        return file_get_contents($content_filename);
    }
}
