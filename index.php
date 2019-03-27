<?php
    include('config.php');
    require(SITE_ROOT . '\requires\connect.php');
    session_start();
    if(isset($_SESSION['user_id'])){
        $sql = "SELECT id, username FROM cms_users WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $_SESSION['user_id']);
        $stmt->execute();   
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $username = $user['Username'];
    }

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
    <title>BoDa Buff</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" type="text/css" media="screen" href="main.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="main.js"></script>
</head>
<body>
    <div class="container">
        <h1>BoDa Buff</h1>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <a href="#" class="navbar-brand">Boda Buff</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav ml_auto">   
                    <li class="nav-item"><a class="nav-link" href="index.php">View Guides</a></li>
                <?php if(!isset($_SESSION['user_id'])): ?>
                    <li class="nav-item"><a class="nav-link" href="register\register.php">Register</a></li>
                    <li class="nav-item"><a class="nav-link" href="login\login.html">Login</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="create\CreateGuide.php">Create</a></li>
                    <li class="nav-item"><a class="nav-link" href="login\logout.php">Logout</a></li>
                <?php endif ?>
            </ul>
            </div>
        </nav>

        <!-- <div class="row">
            <div class="col">
                <div class="alert alert-success alert-dismissable fade show" role="alert">
                    <?php if(isset($_SESSION['userCreate'])): ?>
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
                         <h2>Account created successfully! Thanks <?= $_SESSION['userCreate']?>!</h2> 
                        <?php session_destroy(); ?>
                    <?php endif ?>
                </div>
            </div>
        </div> -->
  
        <?php if(isset($_SESSION['user_id']) || isset($_SESSION['logged_in'])): ?> 
            <h2>Hello, <?= $_SESSION['Username'] ?> !</h2>
        <?php endif ?> 

            <table class="table">
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Hero</th>
                    <th scope="col">Title</th>
                    <th scope="col">User</th>
                </tr>
                <?php foreach($builds as $build): ?>
                <tr>
                    <td><img src="<?= $build['SmallHeroImage'] ?>" alt="<?= $build['HeroName'] ?>"></td>
                    <td><?= $build['HeroName'] ?></td>
                    <td><a href="viewGuides/viewGuide.php?BuildID=<?= $build['BuildID'] ?>"><?= $build['Title'] ?></a></td>
                    <td><?= $build['Username'] ?> </td>
                </tr>
                <?php endforeach ?>
        </table>
    </div>
</body>
</html>