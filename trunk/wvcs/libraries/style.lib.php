<?php
//function of dealing with style-based code

//set icon image address
function icon_address(){
	$base='images/icon/';
	switch (file_name()) {
		case "summary.php":
			$name= "summary.gif";
			break;
		case "project.php":
			$name= "project.gif";
			break;
		case "project_list.php":
			$name= "project_list.gif";
			break;
		case "task.php":
			$name= "task.gif";
			break;
		case "file.php":
			$name= "file.gif";
			break;
		case "directory.php":
			$name= "directory.gif";
			break;
		case "search.php":
			$name= "search.gif";
			break;
		default:
			$name= "default.gif";
	}
	return $base.$name;
}

//set icon image alter message
function icon_alt(){
	switch (file_name()) {
		case "summary.php":
			$alt= "Summary";
			break;
		case "project.php":
			$alt= "Project";
			break;
		case "project_list.php":
			$alt= "Project List";
			break;
		case "task.php":
			$alt= "Task";
			break;
		case "file.php":
			$alt= "File";
			break;
		case "directory.php":
			$alt= "Directory";
			break;
		case "search.php":
			$alt= "Search";
			break;
		default:
			$alt= "Welcome";
	}
	return $alt;
}

//set top bar button status to active by get value
function active($active_string) {
	$name=file_name();
	if ($active_string=="private" and $name=="project.php" and isset($_GET['private'])) {
		echo ' class="active"';
	}
	elseif ($active_string == $name) {
		echo ' class="active"';
	}
	elseif (($name=="project.php" or $name=="task.php" or $name=="file.php" or $name=="directory.php" or $name=="project_list.php") and $active_string == "project") {
		echo ' class="active"';
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
	global $page_title;
	global $page_title_sub;
	$output='';
	if ($title_cat=='html'){
		if (isset($page_title) && isset($page_title_sub)){
			$output=$page_title.' - '.$page_title_sub;
		}
		elseif (isset($_GET['f'])){
			$output='file name - task name';
		}
		elseif (isset($_GET['d'])){
			$output='directory name - task name';
		}
		elseif (isset($_GET['t'])){
			$output='task name - project name';
		}
		elseif (isset($_GET['p'])){
			$output='project name by due date';
		}
		else{
			$output=$system_name;
		}
	}
	elseif ($title_cat=='main'){
		if (isset($page_title)){
			$output=$page_title;
		}
		elseif (isset($_GET['f'])){
			$output='file name';
		}
		elseif (isset($_GET['d'])){
			$output='directory name';
		}
		elseif (isset($_GET['t'])){
			$output='task name';
		}
		elseif (isset($_GET['p'])){
			$output='project name';
		}
		else{
			$output=$system_name;
		}
	}
	elseif ($title_cat=='sub'){
		if (isset($page_title_sub)){
			$output=$page_title_sub;
		}
		elseif (isset($_GET['f'])){
			$output='task name';
		}
		elseif (isset($_GET['d'])){
			$output='task name';
		}
		elseif (isset($_GET['t'])){
			$output='project';
		}
		elseif (isset($_GET['p'])){
			$output='by due date';
		}
		else{
			$output=$system_name_short;
		}
		
	}
	else {
		$output='error';
	}
	echo $output;
}
?>