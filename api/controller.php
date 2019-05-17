<?php
define('FCPATH', '/home/steekam/public_html/IAP/labs'); 

require_once FCPATH."/DBConnector.php"; 

class CONTROLLER {
	protected $db; 

	function __construct() {
		$Dbconn=new DBConnector(); 
		$this->db=$Dbconn->conn; 
	}

	static function generate_response($status, $body=array()) {
		$res=array(
			'status'=>$status, 
			'message'=>$status?'Success':'Something went wrong. Try again', 
			'body'=>$body
		); 
		header('Content-type: application/json'); 
		echo json_encode($res); 
		exit(); 
	}
	
	static function set404() {
		header('HTTP/1.0 404 Not Found'); 
		exit(); 
	}

	static function set403() {
		header('HTTP/1.0 403 Forbidden Access'); 
		exit();
	}
}
