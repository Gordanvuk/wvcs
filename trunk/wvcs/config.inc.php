<?php 
//database connection information
$db_server = 'localhost';
$db_name = 'wvcs';
$db_username_read = 'root';
$db_password_read = '';
$db_username_write = 'root';
$db_password_write = '';

//email of administrator, use for receive error message, and for "from" label on email sends to user
$administrator_email = 'sy595@cs.york.ac.uk';

//system name
$system_name = 'Web-based Version Control System';
$system_name_short = 'WVCS';
$system_version = '1.0';

//login by: email/uid/name_nickname
$login_by = "email";

//redirect to page after successful login
$after_login_redirect = "summary.php";

//cookie valid days
$cookie_valid = 60;

//default time zone
//location strings can be found at http://www.php.net/manual/en/timezones.php
date_default_timezone_set("Europe/London");

//Terms and Conditions (HTML tags needed)
$terms_conditions = '
<p><b>WVCS Terms and Conditions</b></p>
<p>According to Data Protection Act 1998, your personal data will be well protected and will not be passed to third party.</p>
';

?>