<?php
    include('..\config.php');
    require(SITE_ROOT . '\requires\connect.php');
    require_once(SITE_ROOT . '\composer\vendor\autoload.php');
    session_start();


    $ajax_data = [
      "user" =>[]  
    ];

    if(!empty($_POST)){
        $UserID = filter_input(INPUT_POST, 'UserID', FILTER_VALIDATE_INT);
        $query = "SELECT Username, Email, Member, UserID FROM cms_users WHERE UserID = :UserID";
        $statement = $db->prepare($query);
        $statement->bindValue('UserID', $UserID);
        $statement->execute();
        $userData = $statement->fetch(PDO::FETCH_ASSOC);

    }
    // if(filter_input(INPUT_POST, 'productid', FILTER_VALIDATE_INT)){
    //     $productid = filter_input(INPUT_POST, 'productid', FILTER_SANITIZE_NUMBER_INT);
    //     $query = "SELECT name, currentprice, qtyonhand, description, picture FROM products WHERE productid = :productid";
    //     $statement=$db->prepare($query);
    //     $statement->bindValue('productid', $productid);
    //     $statement->execute();
    //     $product = $statement->fetch(PDO::FETCH_ASSOC);

    //     $ajax_data['product'] = $product;
    // }
    // header('Content-type: application/json');
    // echo json_encode($ajax_data);
?>