<?php
//**limit UID of login when view task

//get logged in user
function user_logged_in(){
	if (isset($_SESSION ["user"] ["uid"])){
		return $_SESSION ["user"] ["uid"];
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

//function of list tasks by project ID
function fetch_user_task ($uid){
	$sql='SELECT * FROM task WHERE uid='.$uid.' ORDER BY pid DESC';
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

//function of load directory information from database by directory ID
function fetch_directory($did){
	$sql='SELECT * FROM directory WHERE did='.$did.' ORDER BY did DESC';
	$db_array=db_query($sql);
	if (!array_isset($db_array)){
		return FALSE;
	}
	else{
		return $db_array;
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

//function of read file information from database by file ID
function fetch_file($fid){
	$sql='SELECT * FROM file WHERE fid='.$fid.' ORDER BY fid DESC';
	$db_array=db_query($sql);
	if (!array_isset($db_array)){
		return FALSE;
	}
	else{
		return $db_array;
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

//function of search task_histroy information from database by keywords
function fetch_task_history_search($s){
	$sql='SELECT tid FROM task WHERE name LIKE "%'.$s.'%" ORDER BY tid DESC';
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

//function of search task information from database by keywords
function fetch_task_search($s){
	$sql='SELECT * FROM task WHERE name LIKE "%'.$s.'%" ORDER BY tid DESC';
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

//function of list tasks by project ID
//**limit UID of login at this SQL statement
function fetch_task_project ($tid){
	$sql='SELECT pid FROM task WHERE tid='.$tid.' ORDER BY tid DESC';
	$db_array=db_query($sql);
	if (!array_isset($db_array)){
		return FALSE;
	}
	else{
		$sql_p='SELECT * FROM project WHERE pid='.$db_array[0]['pid'].' ORDER BY pid DESC';
		$db_array_p=db_query($sql_p);
		if (!array_isset($db_array_p)){
			return FALSE;
		}
		else {
			return $db_array_p;
		}
	}
}

//function of identify task finished or not from database by task ID
function fetch_task_finished($tid){
	$sql='SELECT * FROM task WHERE tid='.$tid.' ORDER BY end DESC';
	$db_array_task=db_query($sql);
	$sql2='SELECT * FROM task_history WHERE tid='.$tid.' ORDER BY version DESC';
	$db_array_task_history=db_query($sql2);
	if (isset($db_array_task[0]['end']) and strtotime($db_array_task[0]['end'])<time()){
		return TRUE;
	}
	elseif (isset($db_array_task_history[0]['percent']) and $db_array_task_history[0]['percent']>=100){
		return TRUE;
	}
	else{
		return FALSE;
	}
}

//function of task expired or not
function fetch_task_ready ($tid){
	$sql='SELECT * FROM task WHERE tid='.$tid.' ORDER BY end DESC';
	$db_array_task=db_query($sql);
	$sql2='SELECT * FROM task_history WHERE tid='.$tid.' ORDER BY version DESC';
	$db_array_task_history=db_query($sql2);
	if (isset($db_array_task[0]['start']) and strtotime($db_array_task[0]['start'])<time() and count($db_array_task_history)<1){
		return TRUE;
	}
	else{
		return FALSE;
	}
}

//function of task expired or not
function fetch_task_doing ($tid){
	$sql='SELECT * FROM task WHERE tid='.$tid.' ORDER BY end DESC';
	$db_array_task=db_query($sql);
	$sql2='SELECT * FROM task_history WHERE tid='.$tid.' ORDER BY version DESC';
	$db_array_task_history=db_query($sql2);
	if (isset($db_array_task[0]['start']) and strtotime($db_array_task[0]['start'])<time() and count($db_array_task_history)>=1){
		if ($db_array_task_history[0]['percent']<100){
			return TRUE;
		}
		else {
			return FALSE;
		}
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

//function of list directories by task ID
function fetch_task_directory ($tid){
	$sql='SELECT did FROM directory WHERE tid='.$tid.' ORDER BY did DESC';
	$db_array_did=db_query($sql);
	if (!array_isset($db_array_did)){
		return FALSE;
	}
	else{
		$directory_count=count($db_array_did);
		for ($i = 0; $i < $directory_count; $i++) {
			$db_array_directory=fetch_directory_change($db_array_did[$i]['did']);
			$db_array_directory_change[$i]=$db_array_directory[0];
		}
		return $db_array_directory_change;
	}
}

//function of task_status
function task_status ($tid){
	$status='';
	$db_array_task=fetch_task($tid);
	$db_array_task_history=fetch_task_history($tid);
	if (isset($db_array_task[0]['start']) and strtotime($db_array_task[0]['start'])>time()){
		$status.='Not yet start. ';
	}
	if (isset($db_array_task_history[0]['version']) and count($db_array_task_history)>=1){
		$status.='Ver '.$db_array_task_history[0]['version'].', ('.$db_array_task_history[0]['percent'].'%) ';
	}
	if (isset($db_array_task[0]['end']) and strtotime($db_array_task[0]['end'])<time()){
		$status.='Expired. ';
	}
	if (fetch_task_predecessor_wait($tid)){
		$status.='Waiting for predecessor. ';
	}
	return $status;
}

//function of delete project in database by project ID
function delete_project($pid){
	$sql='DELETE FROM project WHERE pid='.$pid;
	$db_array=db_query($sql);
}

//function of delete task in database by task ID
function delete_task($tid){
	$sql='DELETE FROM task WHERE tid='.$tid;
	$db_array=db_query($sql);
}

//function of delete file in database by file ID
function delete_file($fid){
	$sql='DELETE FROM file WHERE fid='.$fid;
	$db_array=db_query($sql);
}

//function of delete directory in database by directory ID
function delete_directory($did){
	$sql='DELETE FROM directory WHERE did='.$did;
	$db_array=db_query($sql);
}

?>