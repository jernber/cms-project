<?php
    include('..\config.php');
    require(SITE_ROOT . '\requires\connect.php');
    session_start();
    
    if($_POST){
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $passAttempt = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // $sql = "SELECT * from cms_users";
        $sql = "SELECT id, Username, password, email FROM cms_users WHERE email = :email";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
       
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($user == false){
            die('Incorrect email / password combination! 1');
        } else {
            $password = password_verify($passAttempt, $user['password']);
            if($password){
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['logged_in'] = time();
                header(SITE_ROOT . 'index.php');
            } else {
                die('Incorrect email / password combination! 2');
            }
        }
    }
?>