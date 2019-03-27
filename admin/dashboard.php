<?php 
    include('..\config.php');
    require(SITE_ROOT . '\requires\connect.php');
    require_once(SITE_ROOT . '\composer\vendor\autoload.php');
    session_start();

    $query = "SELECT Username, Email, Member FROM cms_users";
    $statement= $db->prepare($query);
    $statement->execute();
    $users = $statement->fetchAll();
    var_dump($users);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
</head>
<body>
    <nav>   
        <ul>    
                <li><a href="ViewGuides\View.php">View Guides</a></li>
            <?php if(!isset($_SESSION['user_id'])): ?>
                <li><a href="register\register.php">Register</a></li>
                <li><a href="..\login\login.html">Login</a></li>
            <?php else: ?>
                <li><a href="create\CreateGuide.php">Create</a></li>
                <li><a href="login\logout.php">Logout</a></li>
            <?php endif ?>
        </ul>
    </nav>
    <table>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Member Status</th>
        </tr>
    <?php foreach($users as $user): ?>
            <tr>
                <td><?= $user['Username'] ?></td>
                <td><?= $user['Email'] ?></td>
            <?php if($user['Member'] == 1): ?>
                <td>Admin</td>
            <?php elseif ($user['Member'] == 2): ?>
                <td>Approved</td>
            <?php else: ?>
                <td>Member</td>
            <?php endif ?>
            </tr>
    <?php endforeach ?>
    </table>
</body>
</html>

