<?php
    include('..\config.php');
    require(SITE_ROOT . '\requires\connect.php');
    require_once(SITE_ROOT . '\composer\vendor\autoload.php');
    session_start();

    $BuildID = filter_input(INPUT_GET, 'BuildID', FILTER_SANITIZE_STRING);
    $Comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);
    $UserID = $_SESSION['user_id'];
    $query = "INSERT INTO cms_comments (UserID, BuildID, Comment) VALUES (:UserID, :BuildID,:Comment)";
    $statement = $db->prepare($query);

    $statement->bindValue("UserID", $UserID);
    $statement->bindValue("BuildID", $BuildID);
    $statement->bindValue("Comment", $Comment);

    $statement->execute();
    header('Location: ..\ViewGuides\ViewGuide.php?BuildID=' . $BuildID);
?>