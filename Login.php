<?php
    session_start();
    ini_set('display_errors',1);
    include_once('User.php');
    include_once('DBConnector.php');

    $DBConnection = new DBConnector;
    if(isset($_POST['login-btn'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $instance = new User();
        $instance->setPassword($password);
        $instance->setUsername($username);
        $instance->login();
        // $DBConnection->closeDatabase();
        // $instance ->createUserSession();
        }
        // else{
        //     $DBConnection->closeDatabase();
        //     $instance->createLoginErrorSession();
        //     header("Refresh : 0");

        // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
     <link rel ='stylesheet' href = './validate.css'/>
    <!-- Compiled and minified JavaScript -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <title>Login</title>
</head>
<body>
    <div class="container">
        <h3>Login</h3>
        <form method='post'>
            <div class="row">
                <div class="col s12">
                    <div class="row">
                        <div class="input-field col s12">
                            <input placeholder="Username" id="username" type="text" class="validate" name = 'username'>
                            <label for="username">Username</label>
                        </div>
                        <div class="input-field col s12">
                            <input placeholder="Password" id="password" type="password" class="validate" name = 'password'>
                            <label for="password">Password</label>
                        </div>
                        <div class="center input-field col s12">
                            <button class="btn waves-effect waves-light" type="submit" name="login-btn">Login
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                        <div class="col s12">
                            <span>Don't have an account? <a style="color : dodgerblue" href='lab1.php'>Sign Up</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>