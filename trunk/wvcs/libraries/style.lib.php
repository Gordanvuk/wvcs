<?php
//function of dealing with style-based code

//set top bar button status to active by get value
function active($active_string) {
	if (isset ( $_GET ['a'] )) {
		if ($active_string == $_GET ['a']) {
			echo ' class="active"';
		}
	}
}

//topbar right align name display(login or logout)
function right_align(){
	if (isset($_SESSION ["user"] ["id"])){
		echo '<a href="login_check.php?logout=1"><strong>'.$_SESSION ["user"] ["name_nickname"].'</strong>&nbsp;&nbsp;Sign Out</a>';
	}
	else{
		echo '<a href="login.php">Sign In</a>';
	}
}

//set html title, page title, page sub title by category value
function page_title($title_cat){
	global $system_name;
	global $system_name_short;
	global $system_name_version;
	$page_title='';
	if ($title_cat=='html'){
		if (isset($_GET['f'])){
			$page_title='file name - task name';
		}
		elseif (isset($_GET['d'])){
			$page_title='directory name - task name';
		}
		elseif (isset($_GET['t'])){
			$page_title='task name - project name';
		}
		elseif (isset($_GET['p'])){
			$page_title='project name by due date';
		}
		else{
			$page_title=$system_name;
		}
	}
	elseif ($title_cat=='main'){
		if (isset($_GET['f'])){
			$page_title='file name';
		}
		elseif (isset($_GET['d'])){
			$page_title='directory name';
		}
		elseif (isset($_GET['t'])){
			$page_title='task name';
		}
		elseif (isset($_GET['p'])){
			$page_title='project name';
		}
		else{
			$page_title=$system_name;
		}
	}
	elseif ($title_cat=='sub'){
		if (isset($_GET['f'])){
			$page_title='task name';
		}
		elseif (isset($_GET['d'])){
			$page_title='task name';
		}
		elseif (isset($_GET['t'])){
			$page_title='project';
		}
		elseif (isset($_GET['p'])){
			$page_title='by due date';
		}
		else{
			$page_title=$system_name_short;
		}
		
	}
	else {
		$page_title='error';
	}
	echo $page_title;
}
?>