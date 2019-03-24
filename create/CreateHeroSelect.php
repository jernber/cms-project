<?php 
    include('..\config.php');
    require(SITE_ROOT . '\requires\connect.php');
    session_start();
    
    $query = "SELECT HeroID, HeroName FROM cms_heroes ORDER BY HeroID";
    $statement = $db->prepare($query);
    $statement->execute();

    $heroes = $statement->fetchAll();
    //var_dump($heroes);
    array_unshift($heroes, ["HeroID" => -1, "HeroName" => "Select a hero..."]);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Create a Guide</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
</head>
<body>
    <nav>
        <ul>
            <?php if(!isset($_SESSION['user_id'])): ?>
                <li><a href="register\register.php">Register</a></li>
                <li><a href="login\login.html">Login</a></li>
            <?php else: ?>
                <li><a href="create\create.php">Create</a></li>
                <li><a href="login\logout.php">Logout</a></li>
            <?php endif ?>
        </ul>
    </nav>
    <h1>Create a guide</h1>
        <form action="createGuide.php" method="POST">
            <label for="heroes">Heroes</label>
            <select name="heroes" id="heroes">
                <?php foreach($heroes as $hero): ?>
                    <option value="<?= $hero['HeroID'] ?>">
                        <?= $hero['HeroName']?>
                    </option>
                <?php endforeach ?>
            </select>
            <button type="submit">Next</button>
        </form>
</body>
</html>