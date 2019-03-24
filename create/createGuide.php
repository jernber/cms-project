<?php
    include('..\config.php');
    require(SITE_ROOT . '\requires\connect.php');
    require_once(SITE_ROOT . '\composer\vendor\autoload.php');
    session_start();
    $query = "SELECT HeroID, HeroName FROM cms_heroes ORDER BY HeroID";
    $statement = $db->prepare($query);
    $statement->execute();
    $heroes = $statement->fetchAll();
    
    array_unshift($heroes, ["HeroID" => -1, "HeroName" => "Select a hero..."]);

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
    <script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=7gfzktuk0ibky5271icimizr2szmqozrwx8t3w9fvj3shac5"></script>
    <script>tinymce.init({
        selector: "textarea",
        forced_root_block : "",
    });
</script>
</head>
<body>
    <nav>   
        <ul>    
                <li><a href="ViewGuides\View.php">View Guides</a></li>
            <?php if(!isset($_SESSION['user_id'])): ?>
                <li><a href="register\register.php">Register</a></li>
                <li><a href="..\login\login.html">Login</a></li>
            <?php else: ?>
                <li><a href="create\CreateGuide.php">Create</a></li>
                <li><a href="login\logout.php">Logout</a></li>
            <?php endif ?>
        </ul>
    </nav>
    <form action="processPost.php" method="POST">
         <label for="heroes">Heroes</label>
            <select name="heroes" id="heroes">
                <?php foreach($heroes as $hero): ?>
                    <option value="<?= $hero['HeroID'] ?>">
                        <?= $hero['HeroName']?>
                    </option>
                <?php endforeach ?>
            </select>
        <label for="title">Guide Name</label>
        <input type="text" name="title" id="title">
        <label for="description"><br>Description</label>
        <p>Provide a quick description of your guide 280 characters max!</p>
        <input type="text" name="description" id="description">
        <label for="details"><br>Details</label>
        <textarea name="details" id="details" cols="10" rows="10"></textarea>
        <button type="submit">Submit</button>
    </form>
</body>
</html>