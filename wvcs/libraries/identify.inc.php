<?php
//if session exist
if (!empty($_SESSION ["user"] ["id"])){
	
}
//if session not exist, but cookie exist
elseif (!empty($_COOKIE['id'])){
	header("Location: login_check.php?cookie=1");
}
//if no session and no cookie
else {
	header("Location: login.php");
}