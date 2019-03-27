<?php
    include('..\config.php');
    require(SITE_ROOT . '\requires\connect.php');
    require_once(SITE_ROOT . '\composer\vendor\autoload.php');
    session_start();
    $BuildID = filter_input(INPUT_GET, 'BuildID', FILTER_SANITIZE_NUMBER_INT);
    $query =  "SELECT BuildID, HeroName, Title, Description, Username, Content FROM cms_builds b JOIN cms_heroes h ON h.HeroID = b.HeroID JOIN cms_users u ON u.UserID = b.UserID WHERE BuildID = ($BuildID)";
    $statement = $db->prepare($query);
    $statement->execute();
    $data =  $statement->fetch();
    $contentDecode = html_entity_decode($data['Content']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $data['Title'] ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" type="text/css" media="screen" href="main.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="main.js"></script>
</head>
<body>
    <nav>   
        <ul>    
                <li><a href="..\ViewGuides\View.php">View Guides</a></li>
            <?php if(!isset($_SESSION['user_id'])): ?>
                <li><a href="..\register\register.php">Register</a></li>
                <li><a href="..\login\login.html">Login</a></li>
            <?php else: ?>
                <li><a href="..\create\CreateGuide.php">Create</a></li>
                <li><a href="..\login\logout.php">Logout</a></li>
            <?php endif ?>
        </ul>
    </nav>
    <?php if (isset($_SESSION['Username'])): ?>
        <?php if($_SESSION['Username'] == $data['Username']): ?>
            <h3><a href="..\create\editGuide.php?BuildID=<?=$data['BuildID'] ?>">Edit</a></h3>
        <?php endif ?>
    <?php endif ?>
    <h1><?= $data['Title'] ?></h1>
    <h2>A build for <?= $data['HeroName']?></h2>
    <h2><?= $data['Description'] ?></h2>
    <h3>Created by <?= $data['Username'] ?></h3>
    <p><?= $contentDecode ?></p>
</body>
</html>