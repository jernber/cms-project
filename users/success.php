<?php
    var_dump($_SESSION);
    create_session();
    if($_SESSION){
        $username = $_SESSION['Username'];
        $email = $_SESSION['Email'];
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Success!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
    
</head>
<body>
    <h1>Account created succesfully! Thanks <?= $username ?> check <?= $email ?> for confirmation email!</h1>
</body>
</html>