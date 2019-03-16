<?php
    session_start();
    require('connect.php');

    if (!isset($_POST['username']) && (!isset($_POST['password']))){
        die ('Username and Password are required.');
    }
  
    if($stmt = $db->prepare('SELECT id, password FROM cms_users WHERE username = ?')){
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows > 0){
            $stmt->bind_results($id, $password);
            $stmt->fetch();

            if(password_verify($_POST['password'], $password)){
                session_regenerate_id();
                $_SESSION['loggedIn'] = true;
                $_SESSION['name'] = $_POST['username'];
                $_SESSION['id'] = $id;
                echo 'Welcome' . $_SESSION['name'] . '!';
            } else {
                echo 'incorrect password!';
            }
        } else {
            echo 'Incorrect username';
        }
    } else {
        echo 'Incorrect username!';
    }
    $stmt->close();
?>