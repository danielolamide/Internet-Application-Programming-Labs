<?php
ini_set('display_errors',1);
require_once 'api_handler.php'; 
$api=new Api_handler(); 

switch ($_SERVER['REQUEST_METHOD']) {
	case 'POST':
		try {
			verify_api_key($api);

			// Create order
			$api->setMeal_name($_POST['meal_name']);
			$api->setMeal_units($_POST['meal_units']);
			$api->setUnit_price($_POST['unit_price']);
			$api->setStatus($_POST['order_status']);
			$res=$api->create_order();
			if (!$res) throw new \Exception("Could not place order");
			Api_handler::generate_response(true,['transaction_msg' => 'Order has been placed']);
		} catch (\Throwable $th) {
			Api_handler::generate_response(false,['transaction_msg' => $th->getMessage()]);
			error_log($th->getMessage());
		}
		break; 

	case 'GET':
		try {
			verify_api_key($api);
			
			if(!empty($_GET)){
				// ? Get order
				$api->setOrder_id($_GET['order_id']);
				$order=$api->check_order_status();
				if (!$order) throw new \Exception("Order record not found");
				Api_handler::generate_response(true,['order' => $order]);
			}

			$orders=$api->fetch_all_orders();
			Api_handler::generate_response(true,['orders' => $orders]);
		} catch (\Throwable $th) {
			Api_handler::generate_response(false,['transaction_msg' => $th->getMessage()]);
			error_log($th->getMessage());
		}
		break; 
	
	default:
		Api_handler::set404();
		break; 
}


/**
 * Get the API Key from headers and verify from records
 *
 * @param Api_handler $api
 * @return void
 */
function verify_api_key($api) {
	$headers = apache_request_headers();
	if(!isset($headers['Authorization'])) Api_handler::set403();
	$header_auth = explode(' ',$headers['Authorization']);
	$header_api_key = end($header_auth);
	$api->setUser_api_key($header_api_key);
	if(!$api->check_api_key()) throw new \Exception("Incorrect api key provided");
}