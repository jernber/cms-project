<?php
    include('config.php');
    require(SITE_ROOT . '\requires\connect.php');
    session_start();
    if(isset($_SESSION['user_id'])){
        $sql = "SELECT id, username FROM cms_users WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $_SESSION['user_id']);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $username = $user['Username'];
    }

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>John BoDa Buff</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
</head>
<body>
    <h1>John BoDa Buff</h1>
    <nav>
        <ul>
            <?php if(!isset($_SESSION['user_id'])): ?>
                <li><a href="register\register.php">Register</a></li>
                <li><a href="login\login.html">Login</a></li>
            <?php else: ?>
                <li><a href="login\logout.php">Logout</a></li>
            <?php endif ?>
        </ul>
    </nav>
    <?php if(isset($_SESSION['userCreate'])): ?>
        <h2>Account created successfully! Thanks <?= $_SESSION['userCreate']?>!</h2>
        <?php session_destroy(); ?>
    <?php endif ?>

    <?php if(isset($_SESSION['user_id']) || isset($_SESSION['logged_in'])): ?> 
        <h2>Hello, <?= $_SESSION['Username'] ?> !</h2>
    <?php endif ?> 
    

</body>
</html>