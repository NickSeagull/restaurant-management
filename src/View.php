<?php
require_once("ContentExtractor.php");
require_once("Renderer.php");

class View {

    private $renderer;
    private $content_extractor;

    private function user_is_not_logged(){
        return !isset($_SESSION['role']);
    }

    private function navbars(){
        $content = $this->content_extractor->get();
        return $content['navbars'];
    }

    private function set_navbar_for($role){
        $this->navbar = $this->navbars()[$role];
    }

    private function set_navbar_on_session(){
        if($this->user_is_not_logged()){
            $this->set_navbar_for('not_logged');
        } else {
            $this->set_navbar_for($_SESSION['role']);
        }
    }

    public function __construct(){
        session_start();
        $this->content_extractor = new ContentExtractor();
        $this->renderer = new Renderer();
        $this->set_navbar_on_session();
    }

    public function render($content){
        $view_navbar = $this->renderer->render_navbar($this->navbar);
        $view_content = $this->renderer->render_content($content);
        include("template.php");
    }
}