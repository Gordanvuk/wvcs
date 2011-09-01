<?php
//receive login details from post data
function receive($var){
	if ($var=='id' && !empty($_POST['id'])){
		return format_sql($_POST['id'], 1);
	}
	elseif ($var=='password' && !empty($_POST['password'])){
		return format_sql($_POST['password'], 0);
	}
	elseif ($var=='remember'){
		if (!empty($_POST['remember'])){
			return true;
		}
		else {
			return false;
		}
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
//set cookie
function cookie_set($name, $value){
	global $cookie_valid;
	setcookie($name, $value, time()+($cookie_valid*3600*24), '/');
}

//check cookie

?>