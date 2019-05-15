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
		private $active_api_key;
		private $profile_image;
		private $utc_timestamp; 
		private $offset;
		private $db;

		private $errors; 

		function __construct() {
			$DbConn=new DBConnector();
			$this->db = $DbConn->conn;

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

		public function save() {
			$fn=$this->first_name; 
			$ln=$this->last_name; 
			$city=$this->city_name; 
			$uname=$this->username; 
			$this->hashPassword(); 
			$pass=$this->password; 
			$profile_image = $this->profile_image;
			
			$sql = 'INSERT INTO user(first_name, last_name, user_city, username, password, profile_image, user_utc_timestamp, offset) VALUES(?,?,?,?,?,?,?,?)';
			$values=[$fn, $ln, $city, $uname, $pass, $profile_image, $this->utc_timestamp, $this->offset];
			$stmt=$this->db->prepare($sql);
			$stmt->bind_param('ssssssii', ...$values);
			$res=$stmt->execute();
			$stmt->close();
			return $res; 
		}
		
		public function readAll() {
			$result=$this->db->query("SELECT * FROM user;"); 
			return mysqli_fetch_all($result, MYSQLI_ASSOC); 
		}
		public function readUnique() {
			return null; 
		}
		public function search($user_id=false, $username = false) {
			$where_clause='';
			$types='';
			$values=[];
			if ($user_id && $username) {
				$where_clause.='WHERE id=? AND username=?';
				$types.='is';
				$values=[$user_id, $username]; 
			} else if($user_id !== FALSE) {
				$where_clause.='WHERE id=?';
				$types.='i';
				$values=[$user_id];
			} else if($username !== FALSE) {
				$where_clause.='WHERE username=?';
				$types.='s';
				$values=[$username];
			}
			$sql='SELECT * FROM user '.$where_clause;
			$stmt = $this->db->prepare($sql);
			$stmt->bind_param($types, ...$values);
			$stmt->execute();
			$row = $stmt->get_result()->fetch_assoc();
			return $row === NULL ? false : $row; 
		}
		public function update() {
			return null; 
		}
		public function removeOne() {
			return null; 
		}
		public function removeAll() {
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
			$username=$this->db->real_escape_string($this->username);
			$user = $this->search(false, $username);
			return $user !== FALSE;
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
			$found=false; 
			$res=$this->db->query("SELECT * FROM user;"); 
			while ($row=mysqli_fetch_array($res)) {
				if (password_verify($this->getPassword(), $row['password']) && $this->getUsername()==$row['username']) {
					$found=true; 
					break; 
				}
			}
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
			$_SESSION['logged_in'] = TRUE;
			$_SESSION['user']=$this->search(false, $this->username);
		}
		
		public function logout() {
			session_destroy(); 
			header("Location:login.php"); 
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