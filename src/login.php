<?php
require_once("view.php");
require_once("ContentExtractor.php");
require_once("Renderer.php");

$raw_navbar  = $content_extractor->get()->navbars->not_logged;
$raw_content = $content_extractor->get()->content->login;
$data = array("view_navbar"  => $renderer->render_navbar($raw_navbar),
              "view_content" => $renderer->render_content($raw_content));

$view = new View();
$view->render("template.php", $data);