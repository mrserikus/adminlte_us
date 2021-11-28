<?php
if(file_exists("install/index.php")){
	//perform redirect if installer files exist
	//this if{} block may be deleted once installed
	header("Location: install/index.php");
}

require_once 'users/init.php';
if(!($user->isLoggedIn())){
	Redirect::to("users/login.php");
} else {
	Redirect::to("dashboard.php");
}
