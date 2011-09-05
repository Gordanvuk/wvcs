<?php
//get logged in user
function user_logged_in(){
	if (isset($_SESSION ["user"] ["id"])){
		return $_SESSION ["user"] ["id"];
	}
	else {
		return FALSE;
	}
}

//function of load dir_changes information from database
function fetch_user($uid){
	$sql='SELECT * FROM user WHERE uid='.$uid;
	$db_array=db_query($sql);
	if (!array_isset($db_array)){
		return FALSE;
	}
	else{
		return $db_array;
	}
}

//function of load project information from database by project ID
function fetch_project($pid){
	$sql='SELECT * FROM project WHERE pid='.$pid.' ORDER BY pid DESC';
	$db_array=db_query($sql);
	if (!array_isset($db_array)){
		return FALSE;
	}
	else{
		return $db_array;
	}
}

//function of list tasks by project ID
//**limit UID of login at this SQL statement
function fetch_project_task ($pid){
	$sql='SELECT * FROM task WHERE pid='.$pid.' ORDER BY pid DESC';
	$db_array=db_query($sql);
	if (!array_isset($db_array)){
		return FALSE;
	}
	else{
		return $db_array;
	}
}

//function of list task history by project ID
function fetch_project_task_history ($pid){
	$sql='SELECT tid FROM task WHERE pid='.$pid.' ORDER BY tid DESC';
	$db_array_tid=db_query($sql);
	if (!array_isset($db_array_tid)){
		return FALSE;
	}
	else{
		$task_count=count($db_array_tid);
		for ($i = 0; $i < $task_count; $i++) {
			$db_array_task=fetch_task_history($db_array_tid[$i]['tid']);
			$db_array_task_history[$i]=$db_array_task[0];
		}
		return $db_array_task_history;
	}
}

//function of load dir_changes information from database by directory ID
function fetch_directory_change($did){
	$sql='SELECT * FROM directory_change WHERE did='.$did.' ORDER BY time DESC';
	$db_array=db_query($sql);
	if (!array_isset($db_array)){
		return FALSE;
	}
	else{
		return $db_array;
	}
}

//function of combine a full directory from database by directory ID
function fetch_directory_full($did){
	if ($did==NULL){
		return "/";
	}
	elseif (fetch_directory_change($did)==FALSE){
		return FALSE;
	}
	else{
		$db_array=fetch_directory_change($did);
		$directory_name=$db_array[0]['name'];
		$directroy_base_id=$db_array[0]['did_base'];
		if ($directroy_base_id==NULL){
			return "/".$directory_name."/";
		}
		elseif ($directroy_base_id!=NULL){
			return $directory_full=fetch_directory_full($directroy_base_id).$directory_name."/";
		}
	}
}

//function of read file_changes information from database by file ID
function fetch_file_change($fid){
	$sql='SELECT * FROM file_change WHERE fid='.$fid.' ORDER BY time DESC';
	$db_array=db_query($sql);
	if (!array_isset($db_array)){
		return FALSE;
	}
	else{
		return $db_array;
	}
}

//function of read task_histroy information from database by task history ID
function fetch_task_history($tid){
	$sql='SELECT * FROM task_history WHERE tid='.$tid.' ORDER BY time DESC';
	$db_array=db_query($sql);
	if (!array_isset($db_array)){
		return FALSE;
	}
	else{
		return $db_array;
	}
}

//function of read task_histroy information from database by task ID
function fetch_task($tid){
	$sql='SELECT * FROM task WHERE tid='.$tid.' ORDER BY end DESC';
	$db_array=db_query($sql);
	if (!array_isset($db_array)){
		return FALSE;
	}
	else{
		return $db_array;
	}
}

//function of identify task finished or not from database by task ID
function fetch_task_finished($tid){
	$sql='SELECT * FROM task WHERE tid='.$tid.' ORDER BY end DESC';
	$db_array_task=db_query($sql);
	$sql2='SELECT * FROM task_history WHERE tid='.$tid.' ORDER BY version DESC';
	$db_array_task_history=db_query($sql2);
	if ($db_array_task[0]['end']<time()){
		return TRUE;
	}
	elseif ($db_array_task_history[0]['percent']>=100){
		return TRUE;
	}
	else{
		return FALSE;
	}
}

//function of read task's predecessor task's ID from database by task ID
function fetch_task_predecessor_tid($tid){
	$sql='SELECT * FROM task WHERE tid='.$tid.' ORDER BY end DESC';
	$db_array=db_query($sql);
	if (!array_isset($db_array)){
		return FALSE;
	}
	else{
		if ($db_array[0]['predecessor']==NULL){
			return FALSE;
		}
		else{
			$tid_p=$db_array[0]['predecessor'];
			return $tid_p;
		}	
	}
}

/////////function of identify task of waiting predecessor or not from database by task ID
function fetch_task_predecessor_wait($tid){
	if (fetch_task_predecessor_tid($tid)){
		$tid_p=fetch_task_predecessor_tid($tid);
		if (fetch_task_finished($tid_p)){
			return FALSE;
		}
		elseif (!fetch_task_finished($tid_p)){
			return TRUE;
		}
	}
	else {
		return FALSE;
	}
}

//function of read task's predecessor task's name from database by task ID
function fetch_task_predecessor_name($tid){
	$sql='SELECT * FROM task WHERE tid='.$tid.' ORDER BY end DESC';
	$db_array=db_query($sql);
	if (!array_isset($db_array)){
		return FALSE;
	}
	else{
		if ($db_array[0]['predecessor']==NULL){
			return FALSE;
		}
		else{
			$tid_p=$db_array[0]['predecessor'];
			$db_array=fetch_task($tid_p);
			return $db_array[0]['name'];
		}	
	}
}

//function of list files by task ID
function fetch_task_file ($tid){
	$sql='SELECT fid FROM file WHERE tid='.$tid.' ORDER BY fid DESC';
	$db_array_fid=db_query($sql);
	if (!array_isset($db_array_fid)){
		return FALSE;
	}
	else{
		$file_count=count($db_array_fid);
		for ($i = 0; $i < $file_count; $i++) {
			$db_array_file=fetch_file_change($db_array_fid[$i]['fid']);
			$db_array_file_change[$i]=$db_array_file[0];
		}
		return $db_array_file_change;
	}
}

//function of task_status
function task_status ($tid){
	$status='';
	$db_array_task=fetch_task($tid);
	$db_array_task_history=fetch_task_history($tid);
	if (strtotime($db_array_task[0]['start'])>time()){
		$status.='Not yet start. ';
	}
	if (count($db_array_task_history)>=1){
		$status.='Ver '.$db_array_task_history[0]['version'].', ('.$db_array_task_history[0]['percent'].'%) ';
	}
	if (strtotime($db_array_task[0]['end'])<time()){
		$status.='Expired. ';
	}
	if (fetch_task_predecessor_wait($tid)){
		$status.='Waiting for pre-task. ';
	}
	return $status;
}

?>