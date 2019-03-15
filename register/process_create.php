<?php
    if($_POST){
        
        //Filters input of the data submitted by the form
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

        //Magic catch all if user creats out of bounds
        if((strlen($username) > 30) OR (strlen($password) > 12) OR (strlen($email) > 60)){
            $error = "Error encountered while creating account.";
            echo $error;
        
        } else {
            ///Bind values to query and submit to database
            require('connect.php');
            $query = "INSERT INTO cms_users (username, password, email) VALUES (:username, :password, :email)";         
            $statement = $db->prepare($query);

            $statement->bindValue(":username", $username);
            $statement->bindValue(":password", $password);
            $statement->bindValue(":email", $email);
            $statement->execute();
            
            session_start();
            
            if(!isset($_SESSION['Username'])){
                $_SESSION['Username'] = $username;
                $_SESSION['Email'] = $email;
            }

            header('location: success.php');
            //header('location: index.php');
        }
        
    }
?>