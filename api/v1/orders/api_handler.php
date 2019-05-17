<?php
require_once '../../controller.php'; 
class Api_handler extends CONTROLLER {
	private $order_id; 
	private $meal_name; 
	private $meal_units; 
	private $unit_price; 
	private $status; 
	private $user_api_key; 

	//? Getter and Setters
	/**
	 * Get the value of order_id
	 */ 
	public function getOrder_id() {
		return $this->order_id; 
	}

	/**
	 * Set the value of order_id
	 *
	 * @return  self
	 */ 
	public function setOrder_id($order_id) {
		$this->order_id=$order_id; 

		return $this; 
	}

	/**
	 * Get the value of meal_name
	 */
	public function getMeal_name() {
		return $this->meal_name; 
	}

	/**
	 * Set the value of meal_name
	 *
	 * @return  self
	 */
	public function setMeal_name($meal_name) {
		$this->meal_name=$meal_name; 

		return $this; 
	}

	/**
	 * Get the value of meal_units
	 */ 
	public function getMeal_units() {
		return $this->meal_units; 
	}

	/**
	 * Set the value of meal_units
	 *
	 * @return  self
	 */ 
	public function setMeal_units($meal_units) {
		$this->meal_units=$meal_units; 

		return $this; 
	}

	/**
	 * Get the value of unit_price
	 */ 
	public function getUnit_price() {
		return $this->unit_price; 
	}

	/**
	 * Set the value of unit_price
	 *
	 * @return  self
	 */ 
	public function setUnit_price($unit_price) {
		$this->unit_price=$unit_price; 

		return $this; 
	}

	/**
	 * Get the value of status
	 */ 
	public function getStatus() {
		return $this->status; 
	}

	/**
	 * Set the value of status
	 *
	 * @return  self
	 */ 
	public function setStatus($status) {
		$this->status=$status; 

		return $this; 
	}

	/**
	 * Get the value of user_api_key
	 */ 
	public function getUser_api_key() {
		return $this->user_api_key; 
	}

	/**
	 * Set the value of user_api_key
	 *
	 * @return  self
	 */ 
	public function setUser_api_key($user_api_key) {
		$this->user_api_key=$user_api_key; 

		return $this; 
	}

	//? Methods
	public function create_order() {
		$sql='INSERT INTO orders(order_name, units, unit_price, order_status) VALUES(?,?,?,?)'; 
		$stmt=$this->db->prepare($sql); 
		$stmt->bind_param('sids', $this->meal_name, $this->meal_units, $this->unit_price, $this->status); 
		$success=$stmt->execute();
		$stmt->close(); 
		return $success; 
	}

	public function check_order_status() {
		$sql='SELECT * FROM orders WHERE order_id=?';
		$stmt=$this->db->prepare($sql);
		$stmt->bind_param('i', $this->order_id);
		$stmt->execute();
		$order=$stmt->get_result()->fetch_assoc();

		return $order === NULL ? false : $order;
	}
	
	public function fetch_all_orders() {
		$sql='SELECT * FROM orders';
		$stmt=$this->db->prepare($sql);
		$stmt->bind_param('i', $order_id);
		$stmt->execute();
		return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
	}

	public function check_api_key() {
		$sql='SELECT api_key FROM api_keys WHERE api_key=? and VALID=1';
		$stmt=$this->db->prepare($sql);
		$stmt->bind_param('s', $this->user_api_key);
		$stmt->execute();
		$rows=$stmt->get_result()->num_rows;
		$stmt->close();
		return $rows === 1;
	}
	
	public function checkContentType() {}

}
