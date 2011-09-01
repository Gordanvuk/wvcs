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
	// Connect to the database for read and write access
	if (@mysql_connect("$db_server", "$db_username_write",
		"$db_password_write"))
		if (@mysql_select_db("$db_name"))
			return TRUE;

	return FALSE;
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
function month_convert($month_text) {
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

// convert DB style date to UK style date
function date_uk($date_db) {
	$date_d = date('j', strtotime($date_db));
	$date_m = date('M', strtotime($date_db));
	$date_y = date('Y', strtotime($date_db));
	if ($date_m == 'Jun') {
		$date_m= 'June';
	}
	if ($date_m == 'Jul') {
		$date_m= 'July';
	}
	$date_uk=$date_d.' '.$date_m.' '.$date_y;
	return $date_uk;
}

// convert UK style date to DB style date
function date_convert($date_uk) {
	$date_db = date('Y-m-d', strtotime($date_uk));
	return $date_db;
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