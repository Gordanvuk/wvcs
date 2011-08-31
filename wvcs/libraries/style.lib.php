<?php
function active($active_string) {
	if (isset ( $_GET ['a'] )) {
		if ($active_string == $_GET ['a']) {
			echo ' class="active"';
		}
	}
}
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