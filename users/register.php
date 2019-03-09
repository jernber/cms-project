<?php
var_dump($_POST);
    if($_POST){
        
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

        if((strlen($username) > 30) OR (strlen($password) > 12) OR (strlen($email) > 60)){
            $error = "Error encountered while creating account.";
            echo $error;
        } else {
            require('connect.php');
            $query = "INSERT INTO cms_bodabuff (username, password, email) VALUES (:username, :password, :email)";         
            $statement = $db->prepare($query);

            $statement->bindValue(":username", $username);
            $statement->bindValue(":password", $password);
            $statement->bindValue(":email", $email);
            $statement->execute();
            
            echo "success";
            //header('location: ');
            //header('location: index.php');
        }
        
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
</head>
<body>
    <form action="process_create.php" method="post">

        <label for="username">Username: </label>
        <input type="text" id="name" name="username">

        <label for="password">Password: </label>
        <input type="text" id="password" name="password">

        <label for="email">Email: </label>
        <input type="email" id="email" name="email">

        <button type="submit">Submit</button>
    </form>
</body>
</html>