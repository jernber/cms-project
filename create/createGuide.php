<?php
    include('..\config.php');
    require(SITE_ROOT . '\requires\connect.php');
    require_once(SITE_ROOT . '\composer\autoload.php');
    session_start();

    if($_POST){
        $HeroID =  $_POST['HeroID'];
        $query = "SELECT SpellName, SpellDescription FROM cms_spells WHERE HeroID = :HeroID";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':HeroID', $HeroID);
        $stmt->execute();
        $heroData->$stmt->fetch();
    } else {
        echo "error on page";
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
</head>
<body>
    <form action="POST">
        <label for="Name">
            
        </label>
    </form>
</body>
</html>