<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
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
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <a href="..\index.php" class="navbar-brand">Boda Buff</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav ml_auto">   
                    <li class="nav-item"><a class="nav-link" href="..\index.php">View Guides</a></li>
                    <li class="nav-item"><a class="nav-link" href="..\heroes.php">View Heroes</a></li>
                <?php if(!isset($_SESSION['user_id'])): ?>
                    <li class="nav-item"><a class="nav-link" href="..\register\register.php">Register</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.html">Login</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="..\create\CreateGuide.php">Create</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                <?php endif ?>
            </ul>
            </div>
        </nav>
        <div class="col">
            <h1>Login</h1>
            <form action="authentication.php" method="POST">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form-control" required>

                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
                
                <input type="submit" value="Login">
            </form>
        </div>
    </div>
</body>
</html>