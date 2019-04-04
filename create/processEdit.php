<?php
    include('..\config.php');
    require(SITE_ROOT . '\requires\connect.php');
    require_once(SITE_ROOT . '\composer\vendor\autoload.php');
    session_start();
    var_dump($_POST);
    
    if(isset($_POST['submit'])){
        $BuildID = filter_input(INPUT_GET, 'BuildID', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $Title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $Content = filter_input(INPUT_POST, 'details', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $Description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if(strlen($Title) < 0 OR (strlen($Description) < 0 OR strlen($Description > 280)) OR strlen($Content) < 0){
            echo "<p>error processing post!</p>";
        } else {
            $query = "UPDATE cms_userbuilds SET Title = :Title, Content = :Content, Description = :Description WHERE BuildID = :BuildID";
            $statement = $db->prepare($query);
            $statement->bindValue(":Title", $Title);
            $statement->bindValue(":Content", $Content);
            $statement->bindValue(":BuildID", $BuildID, PDO::PARAM_INT);
            $statement->bindValue(":Description", $Description);
            $statement->execute();
            header('location: ..\ViewGuides\view.php');
        }
    } 
    if (isset($_POST['delete'])){
        $BuildID = filter_input(INPUT_GET, 'BuildID', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $query = "DELETE FROM cms_userbuilds WHERE BuildID = :BuildID";
        $statement = $db->prepare($query);
        $statement->bindValue(':BuildID', $BuildID, PDO::PARAM_INT);
        $statement->execute();
        header('location: ..\ViewGuides\view.php');
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
    <h1>ice watch</h1>
</body>
</html>