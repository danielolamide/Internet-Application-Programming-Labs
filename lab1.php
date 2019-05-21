<?php
    session_start();
    ini_set('display-errors',1);
    include_once('DBConnector.php');
    include_once('User.php');
    include_once('FileUploader.php');
    $DBConnection = new DBConnector;
    if(isset($_POST['submit-btn'])){
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $city = $_POST['city_name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user = new User($first_name,$last_name,$city,$username,$password);
        //File Upload
        $original_name = $_FILES['profile_image']['name'];
		$file_name_split = explode('.',$_FILES['profile_image']['name']);
		$file_type = strtolower(end($file_name_split));
		$file_size = $_FILES['profile_image']['size'];
		$file_tmp_name = $_FILES['profile_image']['tmp_name'];
		$file_uploader = new FileUploader($original_name,$file_type, $file_size, $file_tmp_name);
        $file_uploader->setAccepted_extensions(['jpeg','jpg','png']);
        if(!$user->validateForm()){
            $user->createFormErrorSessions();
            header("Refresh : 0");
            die();
        }
        else{
            if(!($file_uploader->uploadFile())){
                echo "Failed";
            }
            $user->setProfile_image($file_uploader->getFinalFileName());
            $res = $user->save($DBConnection->conn);

        }

         echo ($res) ? "Success" : "Failed Database Update";


    }
    $DBConnection->closeDatabase();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <!-- Compiled and minified CSS -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
     <link rel ='stylesheet' href = './validate.css'/>
    <!-- Compiled and minified JavaScript -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <title>Internet Application Programming</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <?php
                if(!empty($_SESSION['form-errors'])){
                    echo "<div id='form-errors' class='col s12'>".$_SESSION['form-errors']."</div>";
                    unset($_SESSION['form-errors']);
                }
            ?>
        </div>
        <h3>Registration Form</h3>
        <form method = 'post' enctype='multipart/form-data'>
            <div class="row">
                <div class="col s12">
                    <div class="row">
                        <div class="input-field col s12">
                            <input placeholder="First Name" id="first_name" type="text" class="validate" name = 'first_name'>
                            <label for="first_name">First Name</label>
                        </div>
                        <div class="input-field col s12">
                            <input placeholder="Last Name" id="last_name" type="text" class="validate" name = 'last_name'>
                            <label for="last_name">Last Name</label>
                        </div>
                        <div class="input-field col s12">
                            <input placeholder="City" id="city_name" type="text" class="validate" name = 'city_name'>
                            <label for="city_name">City</label>
                        </div>
                        <div class="input-field col s12">
                            <input placeholder="Username" id="username" type="text" class="validate" name = 'username'>
                            <label for="username">Username</label>
                        </div>
                        <div class="input-field col s12">
                            <input placeholder="Password" id="password" type="password" class="validate" name = 'password'>
                            <label for="password">Password</label>
                        </div>
                        <div class="file-field input-field col s12">
                            <div class="btn">
                                <span>Upload Image</span>
                                <input type="file" name ='profile_image'>
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text">
                            </div>
                        </div>
                        <div class="center input-field col s12">
                            <button class="btn waves-effect waves-light" type="submit" name="submit-btn">Submit
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                        <div class="col s12">
                            <span>Already have an account? <a style="color : dodgerblue" href='Login.php'>Login</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>