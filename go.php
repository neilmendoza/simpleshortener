<?php
require_once 'include/SimpleShortener.php';

$shortener = new SimpleShortener();

$url = $shortener->getUrl($_GET['id']);

if (isset($url)) header('Location: '.$url);
else echo 'Not a valid shortened URL';
?>