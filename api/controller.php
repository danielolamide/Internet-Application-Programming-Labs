<?php
define('FCPATH', '/home/steekam/public_html/IAP/labs');

require_once FCPATH."/DBConnector.php";

class CONTROLLER
{
	protected $db;

	function __construct()
	{ 
		$Dbconn = new DBConnector();
		$this->db = $Dbconn->conn;
	}
}
