<?php
require_once 'App.php';

if(isset($_POST['call']) && !empty($_POST['call'])) {
	$method = $_POST['call']['method'];
	$args = isset($_POST['call']['args']) ? $_POST['call']['args'] : [];
	$app = new App();

	if(method_exists($app, $method)) {
		$app->$method(...$args);
	} else {
		App::set404();
	}
} else {
	App::set404();
}
