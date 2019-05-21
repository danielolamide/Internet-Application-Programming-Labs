<?php

class FileUploader{
    private static $target_directory = 'uploads/';
    private static $size_limit = 50000 ;
    private $uploadOK = false;
    private $file_original_name;
    private $file_type;
    private $file_size;
    private $final_file_name;
    private $file_tmp_name;
    private $accepted_extensions; 
    public $file_upload_errors;

    public function __construct($orginal_name, $file_type, $file_size, $file_tmp_name) {
        $this->file_original_name=$orginal_name; 
        $this->file_type=$file_type; 
        $this->file_size=$file_size; 
        $this->file_tmp_name=$file_tmp_name; 
    }

    public function setOriginalName($name){
        $this->file_original_name=  $name;
    }
    public function getOriginalName(){
        return $this->file_original_name;
    }
    public function setFileType($type){
        $this->file_type = $type;
    }
    public function getFileType(){
        return $this->file_type;
    }
    public function setFileSize($size){
        return $this->file_size = $size;
    }
    public function getFileSize(){
        return $this->file_size;
    }
    public function setFinalName($final_name){
        $this->final_file_name = $final_name;
    }
    public function getFinalFileName(){
        return $this->final_file_name;
    }
    public function getFile_tmp_name() {
        return $this->file_tmp_name; 
    }
    public function setFile_tmp_name($file_tmp_name) {
            $this->file_tmp_name=$file_tmp_name; 
            return $this; 
    }
    public function getAccepted_extensions() {
        return $this->accepted_extensions; 
    }
    public function setAccepted_extensions($accepted_extensions) {
        $this->accepted_extensions=$accepted_extensions; 
        return $this; 
    }

    public function uploadFile(){
        $upload_errors = '';
			try {
				//check file type
				if (!$this->fileTypeIsCorrect()) $upload_errors .= "<p>File extension is not allowed. Try JPG or PNG</p>";
				// check file size
				if (!$this->fileSizeIsCorrect()) $upload_errors .= "<p>File must be less than 50KB</p>";
				//Errors in upload
				if(!empty($upload_errors)) throw new \Exception($upload_errors);
				
				// set final file name
				$file_without_ext = explode('.',$this->file_original_name)[0];
				$this->final_file_name = $file_without_ext.'-'.date('YmdHis').'.'.$this->file_type;
				//create directory if doesn't exist
				if (!file_exists(self::$target_directory)) {
					mkdir($this->target_directory, 0755, true);
				}
				$this->uploadOK = move_uploaded_file($this->file_tmp_name, self::$target_directory.DIRECTORY_SEPARATOR.$this->final_file_name);
			} catch (\Throwable $th) {
				$this->file_upload_errors = $th->getMessage();
			}
			return $this->uploadOK;
    }
    public function fileAlreadyExists(){
        return file_exists($this->target_directory.$this->file_original_name);
    }
    public function fileTypeIsCorrect(){
        return in_array($this->file_type,$this->accepted_extensions);
    }
    public function fileSizeIsCorrect(){
        return $this->file_size < self::$size_limit;
    }


}