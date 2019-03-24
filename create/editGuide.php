<?php
    
    include('..\config.php');
    require(SITE_ROOT . '\requires\connect.php');
    require_once(SITE_ROOT . '\composer\vendor\autoload.php');
    session_start();
    $BuildID = filter_input(INPUT_GET, 'BuildID', FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM cms_builds WHERE BuildID = ($BuildID)";
    $statement = $db->prepare($query);
    $statement->execute();
    $build = $statement->fetch();
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
    <script>tinymce.init({forced_root_block : "",selector:'textarea'});</script>
</head>
<body>
    <form action="processEdit.php?BuildID=<?= $BuildID ?>" method="POST">
    <label for="title">Guide Name</label>
    <input type="text" name="title" id="title" value="<?= $build['Title'] ?>">
    <label for="description"><br>Description</label>
    <p>Provide a quick description of your guide 280 characters max!</p>
    <input type="text" name="description" id="description" value="<?= $build['Description']?>">
    <label for="details"><br>Details</label>
    <textarea name="details" id="details" cols="10" rows="10"><?= $build['Content']?></textarea>
    <button type="submit">Submit</button>
</form>
</body>
</html>