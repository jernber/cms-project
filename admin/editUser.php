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
        $Username = filter_input(INPUT_POST, 'Username', FILTER_SANITIZE_STRING);
        $Email = filter_input(INPUT_POST, 'Email', FILTER_SANITIZE_EMAIL);
        $Member = $_POST['Member'];
        $query = "SELECT Username, Email, Member FROM cms_users WHERE UserID = :UserID"

    }
?>


<?php
require('connect.php');

    $ajax_data =  [
        "product" =>[] 
    ];

    if(filter_input(INPUT_POST, 'productid', FILTER_VALIDATE_INT)){
        $productid = filter_input(INPUT_POST, 'productid', FILTER_SANITIZE_NUMBER_INT);
        $query = "SELECT name, currentprice, qtyonhand, description, picture FROM products WHERE productid = :productid";
        $statement=$db->prepare($query);
        $statement->bindValue('productid', $productid);
        $statement->execute();
        $product = $statement->fetch(PDO::FETCH_ASSOC);

        $ajax_data['product'] = $product;
    }
    header('Content-type: application/json');
    echo json_encode($ajax_data);
?>