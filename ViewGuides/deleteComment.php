<?php
    include('..\config.php');
    require(SITE_ROOT . '\requires\connect.php');
    require_once(SITE_ROOT . '\composer\vendor\autoload.php');
    session_start();

    $CommentID = filter_input(INPUT_GET, 'CommentID', FILTER_SANITIZE_NUMBER_INT);
    $query = "DELETE FROM cms_comments WHERE CommentID = ($CommentID)";
    $statement = $db->prepare($query);
    $statement->execute();

    header('Location: ..\index.php');
?>