<?php

	define('DB_SERVER', 'localhost'); 
	define('DB_USER', 'root'); 
	define('DB_PASS', ''); 
	define('DB_NAME', 'btc3205'); 

	class DBConnector {
		public $conn; 

		function __construct() {
			$this->conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
			if ($this->conn->connect_errno) {
				echo "Failed to connect to MySQL: (" . $this->conn->connect_errno . ") " . $this->conn->connect_error;
				die();
			}
		}
	}
