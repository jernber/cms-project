<?php 
    include('..\config.php');
    require(SITE_ROOT . '\requires\connect.php');
    require_once(SITE_ROOT . '\composer\vendor\autoload.php');
    session_start();

    var_dump($_POST);
    var_dump($_SESSION);
    if($_POST){
        $Title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $Description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $Content = filter_input(INPUT_POST, 'details', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $UserID = $_SESSION['user_id'];
        $HeroID = $_POST['heroes'];

        $query = "INSERT INTO cms_builds (HeroID, UserID, Title, Description, Content) VALUES (:HeroID, :UserID, :Title, :Description, :Content)";         
        $statement = $db->prepare($query);

        $statement->bindValue(":HeroID", $HeroID);
        $statement->bindValue(":UserID", $UserID);
        $statement->bindValue(":Title", $Title);
        $statement->bindValue(":Description", $Description);
        $statement->bindValue(":Content", $Content);
    
        $statement->execute();
        
    }
?>