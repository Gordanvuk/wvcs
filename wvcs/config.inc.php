<?php 
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

//default time zone
$time_zone_default = 0;

//default day light saving time status (0=disabled, 1=active, 2=by server setting)
$dst_status = 2;

//Terms and Conditions
$terms_conditions = '
<p><b>CS Project System Terms and Conditions</b></p>
';

//max version history copies (0=unlimited)
$version_max = 0;

//max storage space (bytes, 0=unlimited)
$version_space = 0;
?>