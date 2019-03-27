<?php
    include('..\config.php');
    require(SITE_ROOT . '\requires\connect.php');
    require_once(SITE_ROOT . '\composer\vendor\autoload.php');
    session_start();

    $query =  "SELECT SmallHeroImage, BuildID, HeroName, Title, Description, Username FROM cms_builds b JOIN cms_heroes h ON h.HeroID = b.HeroID JOIN cms_users u ON u.UserID = b.UserID  ORDER BY BuildID DESC";
    $statement = $db->prepare($query);
    $statement->execute();
    $builds = $statement->fetchAll();

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>View Guides</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" type="text/css" media="screen" href="main.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="main.js"></script>
</head>
<body>
    <nav>   
        <ul>    
                <li><a href="..\ViewGuides\View.php">View Guides</a></li>
            <?php if(!isset($_SESSION['user_id'])): ?>
                <li><a href="..\register\register.php">Register</a></li>
                <li><a href="..\login\login.html">Login</a></li>
            <?php else: ?>
                <li><a href="..\create\CreateGuide.php">Create</a></li>
                <li><a href="..\login\logout.php">Logout</a></li>
            <?php endif ?>
        </ul>
    </nav>
    <h1>Guide Viewer</h1> 
    <table>
        <tr>
            <th></th>
            <th>Hero</th>
            <th>Title</th>
            <th>User</th>
        </tr>
        <?php foreach($builds as $build): ?>
        <tr>
            <td><img src="..\<?= $build['SmallHeroImage'] ?>" alt="<?= $build['HeroName'] ?>"></td>
            <td><?= $build['HeroName'] ?></td>
            <td><a href="viewGuide.php?BuildID=<?= $build['BuildID'] ?>"><?= $build['Title'] ?></a></td>
            <td><?= $build['Username'] ?> </td>
        </tr>
        <?php endforeach ?>
    </table>
</body>
</html>