<?php
include 'config.inc.php';
include 'libraries/general.lib.php';
include 'libraries/login_check.lib.php';
$logout=0;
//if redirect from log out button
if (isset($_GET['logout'])){
	logout();
	header("Location: login.php");
	$logout=1;
}
//if redirect from cookie detecter
elseif (isset($_GET['cookie'])){
	if (!empty($_COOKIE['id'])){
		$id=$_COOKIE['id'];
		$password=$_COOKIE['password'];
		
	}
	else {
		header("Location: login.php");
	}
}
else{
	$id=receive('id');
	$password=md5(receive('password'));//md5
}
if ($logout==0){
	$sql='SELECT * FROM user WHERE '.$login_by.'="'.$id.'" and password="'.$password.'"';
	$db_array=db_query($sql);
	
	//if login fail
	if (!array_isset($db_array)){
		logout();
		login_return();
	}
	//if login OK
	else{
		//set session for login
		session_start();
		$_SESSION ["user"] ["id"] = $db_array[0]['uid'];
		$_SESSION ["user"] ["title"] = $db_array[0]['title'];
		$_SESSION ["user"] ["name_first"] = $db_array[0]['name_first'];
		$_SESSION ["user"] ["name_middle"] = $db_array[0]['name_middle'];
		$_SESSION ["user"] ["name_last"] = $db_array[0]['name_last'];
		$_SESSION ["user"] ["name_nickname"] = $db_array[0]['name_nickname'];
		$_SESSION ["user"] ["email"] = $db_array[0]['email'];
		$_SESSION ["user"] ["password"] = $db_array[0]['password'];
		$_SESSION ["user"] ["type"] = $db_array[0]['type'];
		
		//record user's ip and login time
		$sql='UPDATE user SET lastlogin_ip="'.$_SERVER['REMOTE_ADDR'].'", lastlogin_time="'.time_db(time_this()).'" WHERE '.$login_by.'="'.$id.'" and password="'.$password.'"';
		db_query($sql);
	
		//if ticked "remember me" then set cookie for next auto-login
		if (receive('remember')){
			cookie_set('id', $id);
			cookie_set('password', $password);
		}
		//if login by cookie, back to original page
		if (isset($_GET['cookie'])){
			//back to the page before redirect to here by HTTP_REFERER
			if (isset($_SERVER['HTTP_REFERER'])){
				$url=$_SERVER['HTTP_REFERER'];
			}
			//back to the page before redirect to here by SESSION
			elseif (isset($_SESSION ["system"] ["login_from"])){
				$url=$_SESSION ["system"] ["login_from"];
			}
			else{
				$url=$after_login_redirect;
			}
		}
		//if login from input, back to pre-defined page
		else{
			$url=$after_login_redirect;
		}
		header("Location: $url");
	}
}

?>


<?php
?>