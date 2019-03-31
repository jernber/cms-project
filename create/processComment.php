<?php
    include('..\config.php');
    require(SITE_ROOT . '\requires\connect.php');
    require_once(SITE_ROOT . '\composer\vendor\autoload.php');
    session_start();
    var_dump($_POST);
    var_dump($_GEt);
    $BuildID = filter_input(INPUT_GET, 'BuildID', FILTER_SANITIZE_STRING);
    $query = "INSERT INTO cms_builds (Comments) WHERE BuildID = ($BuildID)";
    $statement = $db->prepare($query);
    $statement->execute();
    header('Location: ..\ViewGuides\ViewGuide.php?BuildId=' . $BuildID);
?>