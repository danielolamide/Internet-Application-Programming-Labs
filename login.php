<?php 
	session_start();
	include_once 'DBConnector.php';
	include_once 'User.php';

	if(isset($_POST['btn_login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$instance = new User();
		$instance->setPassword($password);
		$instance->setUsername($username);
		$instance->login();
	}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  </head>
  <body>
	<div class="container">
			<?php if(isset($_SESSION['msg']) && !empty($_SESSION['msg'])): ?>
				<div class="alert alert-<?= $_SESSION['msg']['type'];?>">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<?= $_SESSION['msg']['content'];?>
					<?php unset($_SESSION['msg']);?>
				</div>
			<?php endif; ?>
			<h2>Login</h2>
			<div class="row">
				<form method="post" style="width: 100%;" action="<?= $_SERVER['PHP_SELF']?>">
					<ediv class="row">
						<div class="input-field col s12">
							<label for="username">Username</label>
							<input type="text" class="validate" name="username" placeholder="Username" required>
						</div>
					</ediv>
					<div class="row">
						<div class="input-field col s12">
							<label for="password">Password</label>
							<input type="password" class="validate" name="password" placeholder="Password" required>
						</div>
					</div>
					<div class="row">
						<div class="col s12 center-align">
							<button type="submit" name="btn_login" class="btn btn-success">Submit
								<i class="material-icons right">send</i>
							</button>
						</div>
					</div>
				</form>
			</div>
			<p style="margin-top: 10px">
				Don't have an account ?<a href="./register.php"> Register</a>
			</p>
		</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>