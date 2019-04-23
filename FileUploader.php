<?php
	class FileUploader {
		private $target_directory="uploads"; 
		private static $size_limit=50000; //in bytes
		private $uploadOK=false; 
		public $file_upload_errors;
		private $accepted_extensions; 
		private $file_original_name; 
		private $file_tmp_name; 
		private $file_type; 
		private $file_size; 
		private $final_file_name; 


		public function __construct($orginal_name, $file_type, $file_size, $file_tmp_name) {
			$this->file_original_name=$orginal_name; 
			$this->file_type=$file_type; 
			$this->file_size=$file_size; 
			$this->file_tmp_name=$file_tmp_name; 
		}
		// * Setters and getters
		/**
		 * Get the value of file_original_name
		 */ 
		public function getFile_original_name() {
				return $this->file_original_name; 
		}

		/**
		 * Set the value of file_original_name
		 *
		 * @return  self
		 */ 
		public function setFile_original_name($file_original_name) {
				$this->file_original_name=$file_original_name; 

				return $this; 
		}

		/**
		 * Get the value of file_type
		 */ 
		public function getFile_type() {
				return $this->file_type; 
		}

		/**
		 * Set the value of file_type
		 *
		 * @return  self
		 */ 
		public function setFile_type($file_type) {
				$this->file_type=$file_type; 

				return $this; 
		}

		/**
		 * Get the value of file_size
		 */ 
		public function getFile_size() {
				return $this->file_size; 
		}

		/**
		 * Set the value of file_size
		 *
		 * @return  self
		 */ 
		public function setFile_size($file_size) {
				$this->file_size=$file_size; 

				return $this; 
		}

		/**
		 * Get the value of final_file_name
		 */ 
		public function getFinal_file_name() {
				return $this->final_file_name; 
		}

		/**
		 * Set the value of final_file_name
		 *
		 * @return  self
		 */ 
		public function setFinal_file_name($final_file_name) {
				$this->final_file_name=$final_file_name; 

				return $this; 
		}

		/**
		 * Get the value of file_tmp_name
		 */ 
		public function getFile_tmp_name() {
				return $this->file_tmp_name; 
		}

		/**
		 * Set the value of file_tmp_name
		 *
		 * @return  self
		 */ 
		public function setFile_tmp_name($file_tmp_name) {
				$this->file_tmp_name=$file_tmp_name; 

				return $this; 
		}

		/**
		 * Get the value of accepted_extensions
		 */ 
		public function getAccepted_extensions() {
				return $this->accepted_extensions; 
		}

		/**
		 * Set the value of accepted_extensions
		 *
		 * @return  self
		 */ 
		public function setAccepted_extensions($accepted_extensions) {
				$this->accepted_extensions=$accepted_extensions; 

				return $this; 
		}

		//* methods
		public function upload_file() {
			$upload_errors = '';
			try {
				//check file type
				if (!$this->file_type_is_correct()) $upload_errors .= "<p>File extension is not allowed. Try JPG or PNG</p>";
				// check file size
				if (!$this->file_size_is_correct()) $upload_errors .= "<p>File must be less than 50KB</p>";
				//Errors in upload
				if(!empty($upload_errors)) throw new \Exception($upload_errors);
				
				// set final file name
				$file_without_ext = explode('.',$this->file_original_name)[0];
				$this->final_file_name = $file_without_ext.'-'.date('YmdHis').'.'.$this->file_type;
				//create directory if doesn't exist
				if (!file_exists($this->target_directory)) {
					mkdir($this->target_directory, 0755, true);
				}
				$this->uploadOK = move_uploaded_file($this->file_tmp_name, $this->target_directory.DIRECTORY_SEPARATOR.$this->final_file_name);
			} catch (\Throwable $th) {
				$this->file_upload_errors = $th->getMessage();
			}
			return $this->uploadOK;
		}

		public function file_already_exists() {
			return file_exists($this->target_directory.$this->file_original_name);
		}

		public function file_type_is_correct() {
			return in_array($this->file_type,$this->accepted_extensions);
		}

		public function file_size_is_correct() {
			return $this->file_size < self::$size_limit;
		}
	}