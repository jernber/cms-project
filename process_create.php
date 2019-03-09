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
