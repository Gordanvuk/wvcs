<?php
//if login has been returned when error, high light error field by pre-defined css tag
function login_error_hl() {
	if (isset ( $_GET ['error'] )) {
		echo ' error';
	}
}
//if login has been returned when ID error, show comment under ID field
function login_id() {
	if (isset ( $_GET ['error'] )) {
		echo '<br /><span class="help-inline">Please check your ID.</span>';
	}
	elseif (!isset ( $_GET ['error'] )) {
		echo '<br /><span class="help-inline">Maybe your e-mail address.</span>';
	}
}
//if login has been returned when password error, show comment under password field
function login_pw() {
	if (isset ( $_GET ['error'] )) {
		echo '<br /><span class="help-inline">Please check your password.</span>';
	}
}
?>