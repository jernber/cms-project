<?php
    include('..\config.php');
    require(SITE_ROOT . '\requires\connect.php');
    session_start();
    
    if($_POST){
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $passAttempt = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $sql = "SELECT id, username, password FROM cms_users WHERE username = :username";
        $stmt = $db->prepare($sql);
        
        $stmt->bindValue(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user === false){
            die('Incorrect username / password combination!');
        } else {
            $password = password_verify($passAttempt, $user['password']);
            if($password){
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['logged_in'] = time();
                echo "successful login!";
            } else {
                die('Incorrect username / password combination!');
            }
        }
    }
?>