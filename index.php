<?php 
ini_set('display_errors',1);
require_once 'inc/config.php';
$page_title='Ordering App';
require_once 'inc/header.php';

?>
<div class="container">
	<div class="center-align">
		<h3>Food Ordering Service</h3>
	</div>
	<div class="row">
		<div class="col s12 m6 l6"'>
			<h3>Placing an order</h3>
			<p>Enter your order details below</p>
			<form method="post" id="place-order-form">
				<div class="input-field col s12 m12 l12">
					<label>Meal name</label>
					<input type="text" name="meal_name" class="validate" required>
				</div>
				<div class="input-field col s12">
					<label>Number of units</label>
					<input type="number" min="1" name="meal_units" class="validate" required>
				</div>
				<div class="input-field col s12">
					<label>Price per unit</label>
					<input type="number" min="1" step="0.01" name="unit_price" class="validate" required>
				</div>
				<div class="input-field col s12">
					<input type="hidden" name="order_status" value="placed" class="validate" required>
				</div>
				<div class="input-field col s12 center">
					<button type="submit" value="Place order" class ="btn waves-effect waves-light">Place Order</button>
				</div>
			</form>
		</div>

		<div class="col s12 m6 l6">
			<h3>Checking order status</h3>
			<p class="lead text-center">Enter your order ID below</p>
			<form method="post" id="order-status-form">
				<div class="input-field col s12">
					<label >Order ID</label>
					<input type="number" min="1" name="order_id" class="validate" required>
				</div>

				<div class="input field col s12 center">
					<button type="submit" value="Check order status" class="btn waves-effect waves-light">Check Order Status</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php require_once 'inc/footer.php'; ?>
