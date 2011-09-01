<?php

//if session exist
if (!empty($_SESSION ["user"] ["email"])){
	
}
//if session not exist, but cookie exist
elseif (!empty($_COOKIE['id'])){
	header("Location: login_check.php?cookie=1");
}
//if no session and no cookie
elseif (file_name()!="login.php") {
	header("Location: login.php");
}