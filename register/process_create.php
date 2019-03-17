<?php
    require_once('..\config.php');
    require(SITE_ROOT . '\requires\connect.php');              
    session_start();

    if($_POST){
        //Magic catch all if user creates out of bounds on username or password
        if((strlen($_POST['username']) > 30) OR (strlen($_POST['password']) > 12) OR (strlen($_POST['email']) > 60)){
            $error = "Error encountered while creating account.";
            echo $error;
        } else {
            //Filters input of the data submitted by the form
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            //Check for username collision
            $sql = "SELECT COUNT(username) AS num FROM cms_users WHERE username = :username";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':username', $username);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row['num'] > 0){
                die('That username already exists!');
            }
            $hashPass = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO cms_users (username, password, email) VALUES (:username, :password, :email)";         
            $statement = $db->prepare($query);
            
            $statement->bindValue(":username", $username);
            $statement->bindValue(":password", $hashPass);
            $statement->bindValue(":email", $email);
            $statement->execute();
            
            if(!isset($_SESSION['Username'])){
                $_SESSION['Username'] = $username;
                $_SESSION['Email'] = $email;
            }

            header('location: success.php');
            //header('location: index.php');
        }
        
    }
?>