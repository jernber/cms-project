<?php
    require_once('..\config.php');
    require(SITE_ROOT . '\requires\connect.php');              
    session_start();
    if($_POST){
        //Magic catch all if user creates out of bounds on username or password
        if((strlen($_POST['username']) > 30) OR (strlen($_POST['password']) > 12) OR (strlen($_POST['email']) > 60) OR ($_POST['password'] != $_POST['confirmPass'])){
            $error = "Error encountered while creating account.";
            echo $error;
        } else {
            //Filters input of the data submitted by the form
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            
            $username = trim($username);
            $email = trim($email);

            //Check for username collision
            $sql = "SELECT COUNT(username) AS num FROM cms_users WHERE username = :username";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':username', $username);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row['num'] > 0){
                die('That username already exists!');
            }
            //Check for email collision
            $sql = "SELECT COUNT(email) AS num from cms_users WHERE email = :email";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':email', $email);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row['num'] > 0){
                die('That email already exists!');
            }

            $hashPass = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO cms_users (username, password, email) VALUES (:username, :password, :email)";         
            $statement = $db->prepare($query);
            
            $statement->bindValue(":username", $username);
            $statement->bindValue(":password", $hashPass);
            $statement->bindValue(":email", $email);
            $statement->execute();
            
          
            $_SESSION['userCreate'] = $username;
            $_SESSION['emailCreate'] = $email;
            

            header('location: ..\index.php');
            //header('location: index.php');
        }
        
    }
?>