<?php
    session_start();
    include_once("User.php");
    $instance = new User();
    $instance->logout();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Logout</title>
</head>
<body>
    <div class="container">
        <span>Thank you for visiting us</span>
        <br>
        <a href="lab1.php">Return to Home</a>
    </div>
</body>
</html>