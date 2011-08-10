<?php
require_once 'include/SimpleShortener.php';

$shortener = new SimpleShortener();

$encoded = $shortener->create($_GET['url']);

$output = array('id' => $encoded);
echo json_encode($output);
?>