<?php 
    include_once ("Crud.php");
    include_once("Authenticator.php");
    include_once('DBConnector.php');
    class User implements Crud, Authenticator{
        private $user_id;
        private $first_name;
        private $last_name;
        private $city_name;


        private $username;
        private $password;

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


        public function __construct1($first_name,$last_name,$city_name,$username,$password){
            $this->first_name = $first_name;
            $this->last_name = $last_name;
            $this->city_name = $city_name;
            $this->username = $username;
            $this->password = $password;
        }
        public static function create(){
            $instance = new self();
            return $instance;
        }
        public function setUsername($username){
            $this->username = $username;
        }
        public function getUsername(){
            return $this->username;
        }
        public function setPassword($password){
            $this->password = $password;
        }
        public function getPassword(){
            return $this->password;
        }
        public function setUserId($user_id){
            $this->user_id = $user_id;
        }
        public function getUserId(){
            return $this->$user_id;
        }
        public function hashPassword(){
            $this->password = password_hash($this->password,PASSWORD_DEFAULT);
        }
        public function isUserExist(){
            $DBConnection  = new DBConnector(); 
            $userExists = false;
            $userExistsQuery = mysqli_query($DBConnection->conn,"SELECT * FROM user WHERE username ='".mysql_real_escape_string($this->getUsername())."'")
                or die("Error ". mysqli_error($DBConnection->conn));
            if(mysqli_num_rows($userExistsQuery)>0){
                $userExists = true;
                $_SESSION['UserExist'] = "A user with this username already exists";
            }
        }
        public function isPasswordCorrect(){
            $DBConnection  = new DBConnector(); 
            $found = false;
            $res =  mysqli_query($DBConnection->conn, "SELECT * FROM user") 
                or die("Error ". mysqli_error($DBConnection->conn));
            while($row = mysqli_fetch_array($res)){
                if(password_verify($this->getPassword(),$row['password']) && $this->getUsername() == $row['username']){
                    $found = true;
                }
            }
            $DBConnection->closeDatabase();
            return $found;
        }
        public function login(){
            if($this->isPasswordCorrect()){
                self::createUserSession();
                header("Location : Private_Page.php");
            }
            else{
                //To add proper error handling
                echo 'Failed';
            }
        }
        public function createUserSession(){
            $_SESSION['username'] = $this->getUsername();
        }
        public function logout(){
            unset($_SESSION['username']);
            session_destroy();
            header('Location:lab1.php');
        }
        public function save($con){
            $fn=$this->first_name; 
			$ln=$this->last_name; 
            $city=$this->city_name; 
            $username=  $this->username;
            $this->hashPassword();
            $password= $this->password; 
            
            $res = mysqli_query($con,"INSERT INTO user(first_name,last_name,user_city,username,password) 
                VALUES('$fn','$ln','$city','$username','$password')")
                or die("Error" . mysqli_error($con));
            return $res;
        }
        public function readAll($con) {
			return null;
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
        public function validateForm(){
            $fn = $this->first_name;
            $ln = $this->last_name;
            $city = $this->city_name;
            if($fn == ""|| $ln == ""|| $city ==""){
                return false;
            }
            return true;
        }
        public function createFormErrorSessions(){
            $_SESSION['form-errors'] = "All fields must be filled";
        }
        public function createLoginErrorSession(){
            $_SESSION['login-error'] = "Invalid Credentials";
        }
    }
