<?php
//function of read file_changes information from database
function get_file($fid){
	$sql='SELECT * FROM file_change WHERE fid="'.$fid.'" ORDER BY time DESC';
	$db_array=db_query($sql);
	if (!array_isset($db_array)){
		return FALSE;
	}
	else{
		return $db_array;
	}
}

?>