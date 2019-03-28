<?php 
    include('..\config.php');
    require(SITE_ROOT . '\requires\connect.php');
    require_once(SITE_ROOT . '\composer\vendor\autoload.php');
    session_start();
    var_dump($_SESSION);
    var_dump($_POST);
    
    if($_POST){
        
        $Title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $Description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $Content = filter_input(INPUT_POST, 'details', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $UserID = $_SESSION['user_id'];
        $HeroID = $_POST['heroes'];

        if(strlen($Title) < 0 OR (strlen($Description) < 0 OR strlen($Description > 280)) OR strlen($Content) < 0 OR $_POST['heroes'] < 0){
            echo "error processing post!";
        } else {

            $query = "INSERT INTO cms_builds (HeroID, UserID, Title, Description, Content) VALUES (:HeroID, :UserID, :Title, :Description, :Content)";         
            $statement = $db->prepare($query);

            $statement->bindValue(":HeroID", $HeroID);
            $statement->bindValue(":UserID", $UserID);
            $statement->bindValue(":Title", $Title);
            $statement->bindValue(":Description", $Description);
            $statement->bindValue(":Content", $Content);
        
            $statement->execute();
            header('location:..\index.php');
        }
    }
?>