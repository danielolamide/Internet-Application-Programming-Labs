<?php
require_once '../../controller.php'; 

class App extends CONTROLLER {
	// ?Functions
	function generate_api_key($str_length=64) {
		//base 62 map
		$chars='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
		// get enough random bits for base 64 encoding (prevent '=' padding)
		$bytes=openssl_random_pseudo_bytes(3 * $str_length / 4 + 1); 

		// Convert base 64 to 62 by mapping + and / to something from the base 62 map
		// Use the first 2 random bytes for the new characters
		$repl=unpack('C2', $bytes); 

		$first=$chars[$repl[1] % 62]; 
		$second=$chars[$repl[2] % 62]; 
		$api_key=str_replace(['/', '+'], [$first, $second], substr(base64_encode($bytes), 0, $str_length)); 
		self::generate_response(true, ['api_key'=>$api_key]); 
	}

	function save_api_key($api_key, $user_id) {
		try {
			$this->db->autocommit(FALSE); 
			$this->invalidate_api_keys($user_id); 
			$sql='INSERT INTO api_keys(user_id, api_key) VALUES(?,?);'; 
			$stmt=$this->db->prepare($sql); 
			$stmt->bind_param('is', $user_id, $api_key); 
			$stmt->execute(); 
			$stmt->close(); 
			$this->db->autocommit(TRUE); 
			self::generate_response(true, ['transaction_msg'=>'API KEY successfully generated']); 
		}catch (\Throwable $th) {
			$this->db->rollback(); 
			self::generate_response(true, ['transaction_msg'=>$th->getMessage()]); 
		}
	}

	function invalidate_api_keys($user_id) {
		$sql='UPDATE api_keys SET valid=0 WHERE user_id=?'; 
		$stmt=$this->db->prepare($sql); 
		$stmt->prepare($sql); 
		$stmt->bind_param('i', $user_id); 
		$stmt->execute(); 
		$stmt->close(); 
	}

	public function get_active_api_key($user_id) {	
		try {
			$sql='SELECT api_key FROM api_keys WHERE user_id=? AND valid=1'; 
			$stmt=$this->db->prepare($sql); 
			$stmt->bind_param('i', $user_id); 
			$stmt->execute(); 
			$row=$stmt->get_result()->fetch_assoc(); 
			$stmt->close(); 
			self::generate_response(true, ['api_key'=>$row['api_key']]); 			
		}catch (\Throwable $th) {
			error_log($th->message()); 
			self::generate_response(false, ['transaction_msg'=>'Error processing request']); 
		}
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
}
