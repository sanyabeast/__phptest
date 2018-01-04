<?php
	require 'vendor/autoload.php';
	require 'src/tools.php';
	require 'src/users.php';

	$action = $_GET["action"];
	$users = new Users();

	if ($action == "register"){
		$users->register($_GET["email"], $_GET["password"], $_GET["username"], function($selector, $token) use ($users){
			$users->confirmEmail($selector, $token);
		});
	} elseif ($action == "login") {
		$users->login($_GET["email"], $_GET["password"], function($data){
			Tools::log(data);
		});
	}

	Tools::log($userName);
?>
