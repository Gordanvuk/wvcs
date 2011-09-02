<?php 
//function of general library, include database operation, error handling, email sending, calculating

//connect to database as read-only account
function connectdb_read()
{
	global $db_server;
	global $db_name;
	global $db_username_read;
	global $db_password_read;
	global $db_username_write;
	global $db_password_write;

	// Connect to the database for read-only access
	if (@mysql_connect("$db_server", "$db_username_read",
		"$db_password_read"))
		if ($result=@mysql_select_db("$db_name"))
			return TRUE;

	return FALSE;
}

//connect to database as write account
function connectdb_rw()
{
	global $db_server;
	global $db_name;
	global $db_username_read;
	global $db_password_read;
	global $db_username_write;
	global $db_password_write;
	
	// Connect to the database for read and write access
	if (@mysql_connect("$db_server", "$db_username_write",
		"$db_password_write"))
		if (@mysql_select_db("$db_name"))
			return TRUE;

	return FALSE;
}

//format inputed data for SQL command use(), if $lower_case==1 convert to lower case
function format_sql($data, $lower_case){
	if (!get_magic_quotes_gpc()){
		$data=addslashes($data);
	}
	$data=trim($data);
	if ($lower_case==1){
		$data=strtolower($data);
	}
	return $data;
}

//format data for HTML display
function format_html($data){
	return htmlspecialchars($data);
}

//count array size. If=0, return false, if>1, return true
function array_isset($array){
	if (count($array)>=1){
		return true;
	}
	else {
		return false;
	}
}

//send email
function send_email($to, $subject, $message) {
	//*******************2 STEP VALIDATION
	global $administrator_email;
	mail($to, $subject, $message, "From: ".$administrator_email);
}

//deal with system errors
function error($message) {
	//********************REDIRECT TO ERROR PAGE AND GET
	global $error_message;
	$error_message = $message;
	global $administrator_email;
	send_email($administrator_email, 'System Error!', $message);
}	

//connect and query database, return 2D array for SELECT query
function db_query($query) {
	
	//use read account for SELECT query and return data set
	if (substr($query, 0, 6) == 'SELECT') {
		if (connectdb_read()) {
			$db_result = mysql_query($query);
		    $i=0;
			$data_array = array();
			while($data_array_line = mysql_fetch_array($db_result)) {
				$data_array[$i] = $data_array_line;
				$i++;
    		}
			return $data_array;
		}
		else {
			error('database connection error (r) ' . mysql_error());
		}
	}
	
	// use read and write account for other query without return
	else {
		if (connectdb_rw()) {
			mysql_query($query);
		}
		else {
			error('database connection error (rw) ' . mysql_error());
		}
	}

}

//calcuate days difference between today and a future date
function days_diff($date) {
	$time = strtotime($date);
	if ($time == FALSE) {
		error('incorrect date format');
		return FALSE;
	} 
	else {
		$days_diff = ($time - time() + 86400) / 86400;
		$days_diff_out = floor($days_diff);
		return $days_diff_out;
	}
}

//convert text month to 2 digits number month
function month_dig($month_text) {
	$month_number = 0;
	switch ($month_text) {
		case "Jan":
			$month_number = 1;
			break;
		case "Feb":
			$month_number = 2;
			break;
		case "Mar":
			$month_number = 3;
			break;
		case "Apr":
			$month_number = 4;
			break;
		case "May":
			$month_number = 5;
			break;
		case "Jun":
			$month_number = 6;
			break;
		case "June":
			$month_number = 6;
			break;
		case "Jul":
			$month_number = 6;
			break;
		case "July":
			$month_number = 7;
			break;
		case "Aug":
			$month_number = 8;
			break;
		case "Sep":
			$month_number = 9;
			break;
		case "Sept":
			$month_number = 9;
			break;
		case "Oct":
			$month_number = 10;
			break;
		case "Nov":
			$month_number = 11;
			break;
		case "Dec":
			$month_number = 12;
			break;
	}
	return $month_number;
}

// validate name text
function validate_name ($text) {
	$result = preg_replace ('/[a-zA-Z\s\'\.]*/isU', '', $text);
	if (strlen($result) > 0) {
		return FALSE;
	}
	elseif (strlen($result) == 0) {
		return TRUE;
	}
}

// convert DB style time to UK style time
function time_uk($time_db) {
	$time_d = date('j', strtotime($time_db));
	$time_m = date('M', strtotime($time_db));
	$time_y = date('Y', strtotime($time_db));
	$time_h = date('G', strtotime($time_db));
	$time_min = date('i', strtotime($time_db));
	$time_s = date('s', strtotime($time_db));
	if ($time_m == 'Jun') {
		$time_m= 'June';
	}
	if ($time_m == 'Jul') {
		$time_m= 'July';
	}
	$time_uk=$time_d.' '.$time_m.' '.$time_y.' '.$time_h.':'.$time_min.':'.$time_s;
	return $time_uk;
}

// show this time
function time_this() {
	$time_d = date('j', time());
	$time_m = date('M', time());
	$time_y = date('Y', time());
	$time_h = date('G', time());
	$time_min = date('i', time());
	$time_s = date('s', time());
	if ($time_m == 'Jun') {
		$time_m= 'June';
	}
	if ($time_m == 'Jul') {
		$time_m= 'July';
	}
	$time_this=$time_d.' '.$time_m.' '.$time_y.' '.$time_h.':'.$time_min.':'.$time_s;
	return $time_this;
}

// log out
function logout() {
	setcookie("id", "", 0, '/');
	setcookie("password", "", 0, '/');
	session_start();
	unset($_SESSION ["user"]);
	unset($_SESSION);
	session_unset();
	session_destroy();
}

// file name of visiting
function file_name(){
	$url = $_SERVER['PHP_SELF']; 
	$filename= substr( $url , strrpos($url , '/')+1 ); 
	return $filename;
}

// convert UK style time to DB style time
function time_db($time_uk) {
	$time_db = date('Y-m-d H:i:s', strtotime($time_uk));
	return $time_db;
}

//compare select bar value and output selected or not
function selected ($option_this, $option_value) {
	if ($option_this == $option_value) {
		return 'selected="selected"';
	}
	else {
		return '';
	}
}

//last page
function last_page(){
	if (isset($_SERVER['HTTP_REFERER'])){
		return $_SERVER['HTTP_REFERER'];
	}
	else{
		global $after_login_redirect;
		return $after_login_redirect;
	}
}

//compare radio button value and output checked or not
function checked ($option_this, $option_value) {
	if ($option_this == $option_value) {
		return "checked=\"checked\"";
	}
	else {
		return '';
	}
}

?>