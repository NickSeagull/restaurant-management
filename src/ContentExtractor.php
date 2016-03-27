<?php
class ContentExtractor {
    public function __construct(){
        $this->content = json_decode(file_get_contents("content.json"), true);
    }

    public function get(){
        return $this->content;
    }
}