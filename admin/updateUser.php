<?php
  include('..\config.php');
  require(SITE_ROOT . '\requires\connect.php');
  require_once(SITE_ROOT . '\composer\vendor\autoload.php');
  session_start();

  if (isset($_POST['UserID'])){
      $UserID = filter_input(INPUT_POST, 'UserID', FILTER_SANITIZE_NUMBER_INT);
      $Username = filter_input(INPUT_POST, 'Username', FILTER_SANITIZE_STRING);
      $Email = filter_input(INPUT_POST, 'Email', FILTER_SANITIZE_EMAIL);
      $Member = filter_input(INPUT_POST, 'Member', FILTER_SANITIZE_NUMBER_INT);

      if (strlen($Username) < 0 OR strlen($Email) < 0){
        echo "<p>Error on updating user </p>";
      } else {
        $query = "INSERT INTO cms_users SET :Email, :Username, :Member WHERE UserID = :UserID";
        $statement = $db->prepare($query);
        $statement->bindValue(":Email", $Email);
        $statement->bindValue(":Username", $Username);
        $statement->bindValue(":Member", $Member);
        $statement->execute();
        header('Location: dashboard.php');
      }
        

  }


    
?>