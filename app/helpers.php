<?php

if (!function_exists('set_active_link')) {
	function set_active_link($path, $active='active') {
		return call_user_func_array('Request::is', (array)$path) ? $active : '';
	}
}
