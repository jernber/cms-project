<?php
    include('..\config.php');
    require(SITE_ROOT . '\requires\connect.php');
    session_start();
    
    if($_POST){
       
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = trim($_POST['email']);
        $passAttempt = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $sql = "SELECT UserID, Username, password, email, Member FROM cms_users WHERE email = :email";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);


        if($user == false){
            die('Incorrect email / password combination!');
        } else {
            $password = password_verify($passAttempt, $user['password']);
            if($password){
                $_SESSION['user_id'] = $user['UserID'];
                $_SESSION['Username'] = $user['Username'];
                $_SESSION['logged_in'] = time();
                $_SESSION['Email'] = $user['Email'];
                $_SESSION['Member'] = $user['Member'];
                header('Location: ..\index.php');
            } else {
                die('Incorrect email / password combination!');
            }
        }
    }
?>