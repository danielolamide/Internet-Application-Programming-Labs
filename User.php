<?php 
	include "./Crud.php"; 
	include "./Authenticator.php"; 
	require_once "./DBConnector.php";
	require_once "./FileUploader.php";
	class User implements Crud, Authenticator {
		private $user_id; 
		private $first_name; 
		private $last_name; 
		private $city_name; 
		private $username; 
		private $password; 
		private $profile_image;
		private $utc_timestamp; 
		private $offset; 

		private $errors; 

		function __construct() {
			$argv=func_get_args(); 
			switch (func_num_args()) {
				case 5:
					self::__construct1($argv[0], $argv[1], $argv[2], $argv[3], $argv[4]); 
					break; 
				default:
					break; 
			}
		}

		function __construct1($first_name, $last_name, $city_name, $username, $password) {
			$this->first_name=$first_name; 
			$this->last_name=$last_name; 
			$this->city_name=$city_name; 
			$this->username=$username; 
			$this->password=$password; 
		}

		// set user_id
		public function setUserId($user_id) {
			$this->user_id=$user_id; 
		}

		//user_id getter
		public function getUserId() {
			return $this->user_id; 
		}

		public function save($con) {
			$fn=$this->first_name; 
			$ln=$this->last_name; 
			$city=$this->city_name; 
			$uname=$this->username; 
			$this->hashPassword(); 
			$pass=$this->password; 
			$profile_image = $this->profile_image;
			$res=mysqli_query($con, "INSERT INTO user(first_name, last_name, user_city, username, password, profile_image, user_utc_timestamp, offset) VALUES ('$fn', '$ln', '$city', '$uname', '$pass', '$profile_image', '$this->utc_timestamp', '$this->offset')")or die("Error: ".mysqli_error($con)); 
			return $res; 
		}
		public static function readAll($con) {
			$result=mysqli_query($con, "SELECT * FROM user;"); 
			return mysqli_fetch_all($result, MYSQLI_ASSOC); 
		}
		public function readUnique($con) {
			return null; 
		}
		public function search($con) {
			return null; 
		}
		public function update($con) {
			return null; 
		}
		public function removeOne($con) {
			return null; 
		}
		public function removeAll($con) {
			return null; 
		}

		public function validateForm() {
			$error_msg=''; 
			$fn=$this->first_name; 
			$ln=$this->last_name; 
			$city=$this->city_name; 
			if ($fn=="" || $ln=="" || $city=="") {
				$error_msg.='<p>All fields are required</p>'; 
			}
			if ($this->isUserExist()) {
				$error_msg.="<p>Username already exists</p>"; 
			}
			$this->errors=$error_msg; 
			return $error_msg!=''; 
		}

		public function isUserExist() {
			$DbConn=new DBConnector(); 
			$username=mysqli_real_escape_string($DbConn->conn, $this->username); 
			$res=mysqli_query($DbConn->conn, "SELECT * FROM user WHERE username = '$username';"); 
			return mysqli_num_rows($res)===1; 
		}

		public function createFormErrorSessions() {
			$_SESSION['form_errors']=$this->errors; 
		}

		/**
		 * Get the value of username
		 */ 
		public function getUsername() {
			return $this->username; 
		}

		/**
		 * Set the value of username
		 *
		 * @return  self
		 */ 
		public function setUsername($username) {
			$this->username=$username; 
		}

		/**
		 * Get the value of password
		 */ 
		public function getPassword() {
			return $this->password; 
		}

		/**
		 * Set the value of password
		 *
		 * @return  self
		 */ 
		public function setPassword($password) {
			$this->password=$password; 
		}

		// authenticator methods
		public function hashPassword() {
			$this->password=password_hash($this->password, PASSWORD_BCRYPT); 
		}

		public function isPasswordCorrect() {
			$DbConn=new DBConnector(); 
			$found=false; 
			$res=mysqli_query($DbConn->conn, "SELECT * FROM user;"); 
			while ($row=mysqli_fetch_array($res)) {
				if (password_verify($this->getPassword(), $row['password']) && $this->getUsername()==$row['username']) {
					$found=true; 
					break; 
				}
			}
			$DbConn->closeDatabase(); 
			return $found; 
		}

		public function login() {
			if ($this->isPasswordCorrect()) {
				self::createUserSession(); 
				header("Location:private_page.php"); 
			}else {
				$_SESSION['msg']=array(
					'type'=>'danger', 
					'content'=>"Invalid username/password"); 
				header("Refresh:0"); 
				die(); 
			}
		}

		public function createUserSession() {
			$_SESSION['username']=$this->getUsername(); 
		}
		
		public function logout() {
			unset($_SESSION['username']); 
			session_destroy(); 
			header("Location:lab1.php"); 
		}

		/**
		 * Get the value of profile_image
		 */ 
		public function getProfile_image() {
				return $this->profile_image; 
		}

		/**
		 * Set the value of profile_image
		 *
		 * @return  self
		 */ 
		public function setProfile_image($profile_image) {
				$this->profile_image=$profile_image; 

				return $this; 
		}

		/**
		 * Get the value of utc_timestamp
		 */ 
		public function getUtc_timestamp(){
				return $this->utc_timestamp;
		}

		/**
		 * Set the value of utc_timestamp
		 *
		 * @return  self
		 */ 
		public function setUtc_timestamp($utc_timestamp){
				$this->utc_timestamp = $utc_timestamp;
				return $this;
		}

		/**
		 * Get the value of offset
		 */ 
		public function getOffset()	{
				return $this->offset;
		}

		/**
		 * Set the value of offset
		 *
		 * @return  self
		 */ 
		public function setOffset($offset){
				$this->offset = $offset;
				return $this;
		}
	}