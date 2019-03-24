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
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $data['Title'] ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
</head>
<body>
    <?php if($_SESSION['Username'] == $data['Username']): ?>
        <h3><a href="..\create\editGuide.php?BuildID=<?=$data['BuildID'] ?>">Edit</a></h3>
    <?php endif ?>
    <h1><?= $data['Title'] ?></h1>
    <h2>A build for <?= $data['HeroName']?></h2>
    <h2><?= $data['Description'] ?></h2>
    <h3>Created by <?= $data['Username'] ?></h3>
    <p><?= $data['Content'] ?></p>
</body>
</html>