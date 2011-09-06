<?php
//start session
session_start();

//if user session exist
if (!empty($_SESSION ["user"] ["uid"])){
	
}
//if user session not exist, but cookie exist
elseif (!empty($_COOKIE['id'])){
	$_SESSION ["system"] ["login_from"]=$_SERVER["REQUEST_URI"];
	header("Location: login_check.php?cookie=1&");
}
//if no session and no cookie
elseif (file_name()!="login.php") {
	header("Location: login.php");
}