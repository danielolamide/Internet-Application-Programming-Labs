<?php 
    include_once ("Crud.php");
    class User implements Crud{
        private $user_id;
        private $first_name;
        private $last_name;
        private $city_name;

        function __construct($first_name,$last_name,$city_name){
            $this->first_name = $first_name;
            $this->last_name = $last_name;
            $this->city_name = $city_name;
        }

        public function setUserId($user_id){
            $this->user_id = $user_id;
        }

        public function getUserId(){
            return $this->$user_id;
        }

        public function save($con){
            $fn=$this->first_name; 
			$ln=$this->last_name; 
            $city=$this->city_name; 
            $res = mysqli_query($con,"INSERT INTO user(first_name,last_name,user_city) VALUES('$fn','$ln','$city')")
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
    }
