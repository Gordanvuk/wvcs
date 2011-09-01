<?php
//receive login details from post data
function receive($var){
	if ($var=='id' && isset($_POST['id'])){
		return $_POST['id'];
	}
	elseif ($var=='password' && isset($_POST['password'])){
		return $_POST['password'];
	}
	else {
		login_return();
	}
}
//if login fail, return back to login page
function login_return(){
	if (isset($_POST['id'])){
		$url="login.php?error=1&u=".$_POST['id'];
	}
	elseif (!isset($_POST['id'])){
		$url="login.php?error=1";
	}
	header("Location: $url");
}
//check login details in DB
//write login record in DB
//set cookie in DB
//check cookie

?>