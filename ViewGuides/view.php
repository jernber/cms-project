<?php
    include('..\config.php');
    require(SITE_ROOT . '\requires\connect.php');
    require_once(SITE_ROOT . '\composer\vendor\autoload.php');
    session_start();

    $query =  "SELECT BuildID, HeroName, Title, Description, Username FROM cms_builds b JOIN cms_heroes h ON h.HeroID = b.HeroID JOIN cms_users u ON u.UserID = b.UserID  ORDER BY BuildID DESC";
    $statement = $db->prepare($query);
    $statement->execute();
    $builds = $statement->fetchAll();

    
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>View Guides</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
</head>
<body>
    <ul>
        <?php if(!isset($_SESSION['user_id'])): ?>
                <li><a href="register\register.php">Register</a></li>
                <li><a href="login\login.html">Login</a></li>
        <?php else: ?>
                <li><a href="create\create.php">Create</a></li>
                <li><a href="login\logout.php">Logout</a></li>
        <?php endif ?>
    </ul>
    <h1>Guide Viewer</h1> 
    <table>
        <tr>
            <th>Hero</th>
            <th>Title</th>
            <th>User</th>
        </tr>
        <?php foreach($builds as $build): ?>
        <tr>
            <td><?= $build['HeroName'] ?></td>
            <td><a href="viewGuide.php?BuildID=<?= $build['BuildID'] ?>"><?= $build['Title'] ?></a></td>
            <td><?= $build['Username'] ?> </td>
        </tr>
        <?php endforeach ?>
    </table>
</body>
</html>