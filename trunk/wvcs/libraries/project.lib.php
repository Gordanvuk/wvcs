<?php
//function of read file_changes information from database
function fetch_file($fid){
	$sql='SELECT * FROM file_change WHERE fid="'.$fid.'" ORDER BY time DESC';
	$db_array=db_query($sql);
	if (!array_isset($db_array)){
		return FALSE;
	}
	else{
		return $db_array;
	}
}

//function of load dir_changes information from database
function fetch_directory($did){
	$sql='SELECT * FROM directory_change WHERE did="'.$did.'" ORDER BY time DESC';
	$db_array=db_query($sql);
	if (!array_isset($db_array)){
		return FALSE;
	}
	else{
		return $db_array;
	}
}

//function of combine a full directory from database
function full_directory($did){
	if (fetch_directory($did)==FALSE){
		return FALSE;
	}
	else{
		$db_array=fetch_directory($did);
		$directory_name=$db_array[0]['name'];
		$directroy_upper_id=$db_array[0]['did_upper'];
		if ($db_array[0]['did_upper']==NULL){
			return $directory_name."/";
		}
		elseif ($db_array[0]['did_upper']!=NULL){
			$directroy_upper_id=$db_array[0]['did_upper'];
			return $directory_name."/".full_directory($directroy_upper_id);
		}
	}
}

?>