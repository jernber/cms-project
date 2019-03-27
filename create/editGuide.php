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
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" type="text/css" media="screen" href="main.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="main.js"></script>
    <script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=7gfzktuk0ibky5271icimizr2szmqozrwx8t3w9fvj3shac5"></script>
    <script>tinymce.init({
        selector: "textarea",
        forced_root_block : "",
    });
</script>
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
    <button type="submit" name="submit" value='submit'>Submit</button>
    <button type="submit" name="delete" value='delete'>Delete</button>
</form>
</body>
</html>