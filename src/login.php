<?php
require_once("View.php");
require_once("ContentExtractor.php");

$content_extractor = new ContentExtractor();
$content = $content_extractor->get();

$view = new View();
$view->render('login');