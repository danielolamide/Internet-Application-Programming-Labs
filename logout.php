<?php
	session_start();
	require_once './User.php';
	$instance = new User();
	$instance->logout();