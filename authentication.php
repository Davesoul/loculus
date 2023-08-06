<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
	
	require 'include/classes.php';

	if(isset($_SESSION['lock'])){
		$timecounter = time() - $_SESSION['lock'];
		if($timecounter > 10){
			unset($_SESSION['log_attempt']);
			unset($_SESSION['lock']);
		}
	}
	
	
	ob_start();
	session_start();
	
	$user = new user();
	
	if(isset($_GET['logout'])){
		$user->logout();
	}
