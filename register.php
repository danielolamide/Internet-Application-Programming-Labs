<?php
	session_start();
	ini_set('display_errors',1);
	include_once 'DBConnector.php';
	include_once 'User.php';
	$DBConn = new DBConnector();

	// set form errors
	if(!empty($_SESSION['form_errors'])){
		$_SESSION['msg'] = array(
			'type' => 'danger',
			'content' => $_SESSION['form_errors']
		);
		unset($_SESSION['form_errors']);
	}

	//data insert
	if(isset($_POST['btn_save'])) {
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$city = $_POST['city_name'];
		$username = $_POST['username'];
		$password = $_POST['password'];

		$utc_timestamp = $_POST['utc_timestamp'];
		$offset = $_POST['time_zone_offset'];

		//create user object
		$user = new User($first_name, $last_name, $city, $username, $password);
		$user->setUtc_timestamp($utc_timestamp);
		$user->setOffset($offset);

		// ?upload profile image
		$original_name = $_FILES['profile_image']['name'];
		$file_name_split = explode('.',$_FILES['profile_image']['name']);
		$file_type = strtolower(end($file_name_split));
		$file_size = $_FILES['profile_image']['size'];
		$file_tmp_name = $_FILES['profile_image']['tmp_name'];
		$file_uploader = new FileUploader($original_name,$file_type, $file_size, $file_tmp_name);
		$file_uploader->setAccepted_extensions(['jpeg','jpg','png']);
		if(!$file_uploader->upload_file()) {
			$_SESSION['msg'] = array(
				'type' => 'danger',
				'content' => $file_uploader->file_upload_errors
			);
			header("Refresh:0");
			die();
		}
		$user->setProfile_image($file_uploader->getFinal_file_name());
		if($user->validateForm()) {
			$user->createFormErrorSessions();
			header("Refresh:0");
			die();
		}
		$res = $user->save($DBConn->conn);		
		$_SESSION['msg'] = array(
			'type' => $res ? 'success' : 'danger',
			'content' => $res ? "Save operation was successful" : "An error occurred!"
		);
	}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Registration</title>

   	<!-- Compiled and minified CSS -->
	   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

		<script src="./validate.js"></script>
  </head>
  <body>
		<div class="container-fluid">
			<div class="d-flex justify-content-center" style="height: 100%;">
				<div class="container px-sm-0">
					<div class="mt-2">
						<?php if(isset($_SESSION['msg']) && !empty($_SESSION['msg'])): ?>
							<div class="alert alert-<?= $_SESSION['msg']['type'];?>">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<?= $_SESSION['msg']['content'];?>
								<?php unset($_SESSION['msg']);?>
							</div>
						<?php endif; ?>
					</div>
					<h2 class="text-center">Registration</h2>
					<div class="row">
						<form class='col s12' method="post" style="width: 100%;" action="<?= $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
							<div class="row">
								<div class="input-field col s12">
									<label for="first_name">First name</label>
									<input type="text" class="validate" name="first_name" id="first_name" required>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
								<label for="last_name">Last name</label>
									<input type="text" class="validate" name="last_name" id="last_name">
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<label for="city_name">City name</label>
									<input type="text" class="validate" name="city_name" id="city_name">
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<label for="username">Username</label>
									<input type="text" class="validate" name="username" id="username" required>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<input type="password" class="validate" name="password" id="password" required>
									<label for="password">Password</label>
								</div>
							</div>
							<div class="file-field input-field">
								<div class="btn">
									<span>Profile Image</span>
									<input type="file">
								</div>
								<div class="file-path-wrapper">
									<input class="file-path validate" type="text">
								</div>
							</div>
							<input type="hidden" name="utc_timestamp" id="utc_timestamp">
							<input type="hidden" name="time_zone_offset" id="time_zone_offset">
							<div class="row">
								<div class="col s12 center-align">
									<button type="submit" name="btn_save" class="btn btn-success">Submit
										<i class="material-icons right">send</i>
									</button>
								</div>
							</div>
						</form>
					</div>
					<p>
						Already have an account ?<a href="./login.php"> Login</a>
					</p>
				</div>
			</div>
		</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script src="timezone.js"></script>
  </body>
</html>