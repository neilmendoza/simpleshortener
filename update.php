<?php
require_once 'include/SimpleShortener.php';
if (
	isset($_SERVER['PHP_AUTH_USER']) &&
	isset($_SERVER['PHP_AUTH_PW']) &&
	$_SERVER['PHP_AUTH_USER'] == API_USER &&
	$_SERVER['PHP_AUTH_PW'] == API_PASS
)
{
	$shortener = new SimpleShortener();
	
	if (isset($_GET['id']) && isset($_GET['url']))
	{
		$encoded = $shortener->update($_GET['id'], $_GET['url']);
	}
	if ($encoded) $output = array('id' => $encoded);
	else $output = array('error' => 'Could not update');
	echo json_encode($output);
}
else
{
	header('WWW-Authenticate: Basic realm="My Realm"');
	header('HTTP/1.0 401 Unauthorized');
	echo 'Unauthorised';
	exit;
}
?>