<?php
    if(!isset($_SESSION['username'])){
        header("Location : Login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Private Page</title>
</head>
<body>
    <div class="container">
        <h3>This is a private page</h3>
        <br>
        <span>We want to protect it</span>
        <br>
        <a style = "color : dodgerblue" href="Logout.php">Logout</a>
    </div>
</body>
</html>