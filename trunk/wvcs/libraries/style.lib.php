<?php
function active($active_string) {
	if (isset ( $_GET ['a'] )) {
		if ($active_string == $_GET ['a']) {
			echo ' class="active"';
		}
	}
}