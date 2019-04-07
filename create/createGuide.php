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
    <div class="container">

        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <a href="#" class="navbar-brand">Boda Buff</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav ml_auto">   
                    <li class="nav-item"><a class="nav-link" href="..\index.php">View Guides</a></li>
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

        <div class="row">
            <div class="col">
                <form action="processPost.php" method="POST" enctype='multipart/form-data'>
                    <label for="title">Guide Name</label>
                        <input type="text" name="title" id="title" class="form-control">
                    <label for="heroes">Hero</label>
                            <select name="heroes" id="heroes" class="form-control">
                                <?php foreach($heroes as $hero): ?>
                                    <option value="<?= $hero['HeroID'] ?>">
                                        <?= $hero['HeroName']?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" name="description" id="description" class="form-control">
                        <small>Provide a quick description of your guide 280 characters max!</small>
                    </div>
                    <label for="details"><br>Details</label>
                    <textarea name="details" id="details" cols="10" rows="10"></textarea>

                    <label for='image'>Image Filename:</label>
                    <input type='file' name='image' id='image'>

                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>