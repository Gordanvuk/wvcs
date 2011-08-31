<?php
function login_error_hl() {
	if (isset ( $_GET ['error'] )) {
		echo ' error';
	}
}
function login_id() {
	if (isset ( $_GET ['error'] )) {
		echo '<br /><span class="help-inline">Please check your ID.</span>';
	}
	elseif (!isset ( $_GET ['error'] )) {
		echo '<br /><span class="help-inline">Maybe your e-mail address.</span>';
	}
}
function login_pw() {
	if (isset ( $_GET ['error'] )) {
		echo '<br /><span class="help-inline">Please check your password.</span>';
	}
}
?>