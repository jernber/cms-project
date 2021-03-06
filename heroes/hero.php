<?php
    include('..\config.php');
    require(SITE_ROOT . '\requires\connect.php');
    require_once(SITE_ROOT . '\composer\vendor\autoload.php');
    session_start();

    $HeroID = filter_input(INPUT_GET, 'HeroID', FILTER_SANITIZE_NUMBER_INT);

    $heroQuery = "SELECT HeroID, HeroName, HeroDescription, HeroImage FROM cms_heroes WHERE HeroID = :HeroID";
    $stmt = $db->prepare($heroQuery);
    $stmt->bindValue("HeroID", $HeroID);
    $stmt->execute();
    $hero = $stmt->fetch(); 

    $query = "SELECT SpellName, SpellIcon, SpellDescription FROM cms_spells WHERE HeroID = :HeroID";
    $statement = $db->prepare($query);
    $statement->bindValue("HeroID", $HeroID);
    $statement->execute();
    $spells = $statement->fetchAll();

    $buildQuery =  "SELECT SmallHeroImage, BuildID, HeroName, Title, Description, Username, h.HeroID FROM cms_userbuilds b JOIN cms_heroes h ON h.HeroID = b.HeroID JOIN cms_users u ON u.UserID = b.UserID WHERE HeroID = :HeroID ORDER BY BuildID DESC";
    $buildStatement = $db->prepare($buildQuery);
    $buildStatement->bindValue("HeroID", $HeroID);
    $buildStatement->execute();
    $buildStuff = $buildStatement->fetchAll();
    var_dump($buildStuff);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $hero['HeroName'] ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <a href="..\index.php" class="navbar-brand">Boda Buff</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav ml_auto">   
                    <li class="nav-item"><a class="nav-link" href="..\index.php">Guides</a></li>
                    <li class="nav-item"><a class="nav-link" href="..\ViewGuides\heroes.php">Heroes</a></li>
                <?php if(!isset($_SESSION['user_id'])): ?>
                    <li class="nav-item"><a class="nav-link" href="..\register\register.php">Register</a></li>
                    <li class="nav-item"><a class="nav-link" href="..\login\login.php">Login</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="..\create\CreateGuide.php">Create</a></li>
                    <li class="nav-item"><a class="nav-link" href="..\login\logout.php">Logout</a></li>
                <?php endif ?>
            </ul>
            </div>
        </nav>

        <div class="col">
            <h1><?= $hero['HeroName'] ?></h1>
            <img src="..\<?= $hero['HeroImage']?>" alt="<?= $hero['HeroName'] ?>">
            <div class="row">
                    <?php foreach($spells as $spell): ?>
                        <div class="col">
                            <img src="..\<?= $spell['SpellIcon'] ?>" alt="<?= $spell['SpellName'] ?>">
                            <h2><?= $spell['SpellName'] ?></h2>
                            <h3><?= $spell['SpellDescription'] ?></h3>
                        </div>
                    <?php endforeach ?>
            </div>
        </div>

        <?php if(count($buildStuff) > 0): ?>
        <table class="table">
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Hero</th>
                    <th scope="col">Title</th>
                    <th scope="col">User</th>
                </tr>
                <?php foreach($buildStuff as $build): ?>
                <tr>
                    <td><img src="<?= $build['SmallHeroImage'] ?>" alt="<?= $build['HeroName'] ?>"></td>
                    <td><a href="heroes\hero.php?HeroID=<?= $build['HeroID'] ?>"><?= $build['HeroName'] ?></a></td>
                    <td><a href="viewGuides/viewGuide.php?BuildID=<?= $build['BuildID'] ?>"><?= $build['Title'] ?></a></td>
                    <td><?= $build['Username'] ?> </td>
                </tr>
                <?php endforeach ?>
        </table>    
    <?php endif ?>
    </div>
</body>
</html>