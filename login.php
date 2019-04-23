<?php 
	session_start();
	ini_set('display_errors',1);
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
    <title>Lab Login</title>

    <!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		
		<style>
			#main {
				width: 60%;
			}
			@media screen and (max-width: 567px) {
				#main {
					width: 90%;
				}
			}
		</style>
  </head>
  <body>
	<div class="container-fluid" style="height: 100vh; padding:0;">
			<div class="d-flex justify-content-center align-items-center" style="height: 100%;">
				<div class="container" id="main">
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
							<div class="form-group">
								<input type="text" class="form-control" name="username" placeholder="Username" required>
							</div>
							<div class="form-group">
								<input type="password" class="form-control" name="password" placeholder="Password" required>
							</div>
							<button type="submit" name="btn_login" class="btn btn-success">Login</button>
						</form>
					</div>
					<p style="margin-top: 10px">
						Don't have an account ?<a href="./lab1.php"> Register</a>
					</p>
				</div>
			</div>
		</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>