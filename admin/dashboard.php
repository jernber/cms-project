<?php 

    include('..\config.php');
    require(SITE_ROOT . '\requires\connect.php');
    require_once(SITE_ROOT . '\composer\vendor\autoload.php');
    session_start();
    
    if($_SESSION['Member'] == 1){
        $query = "SELECT UserID, Username, Email, Member FROM cms_users";
        $statement = $db->prepare($query);
        $statement->execute();
        $users = $statement->fetchAll();
    
        $query = "SELECT BuildID, Title, Username FROM cms_userbuilds b JOIN cms_users u ON b.UserID = u.UserID ORDER BY BuildID DESC";
        $statement = $db->prepare($query);
        $statement->execute();
        $builds = $statement->fetchAll();
    } else {
        echo '<p>Oops! A mistake has happened</p>';
    }

    if(isset($_POST['submit'])){
        $UserID = filter_input(INPUT_POST, 'UserID', FILTER_SANITIZE_NUMBER_INT);
        $Username = filter_input(INPUT_POST, 'Username', FILTER_SANITIZE_STRING);
        $Email = filter_input(INPUT_POST, 'Email', FILTER_SANITIZE_EMAIL);
        $Member = filter_input(INPUT_POST, 'Member', FILTER_SANITIZE_NUMBER_INT);

        $query = "UPDATE cms_users SET Email=:Email, Username=:Username, Member = :Member WHERE UserID = ($UserID)";
        $statement = $db->prepare($query);
        $statement->bindValue(":Email", $Email);
        $statement->bindValue(":Username", $Username);
        $statement->bindValue(":Member", $Member);
        $statement->execute();
        header('Location: dashboard.php');
    }
    if(isset($_POST['delete'])){
        $UserID = filter_input(INPUT_POST, 'UserID', FILTER_SANITIZE_NUMBER_INT);
        $query = "DELETE FROM cms_users WHERE UserID = ($UserID)";
        $statement = $db->prepare($query);
        $statement->execute();
        header('Location: dashboard.php');
    }

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" type="text/css" media="screen" href="main.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="userdata.js"></script>
    <!-- <script src="main.js"></script> -->
</head>
<body>
    <div class="container">

    <div class="modal fade" id="userModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h2 class="modal-title">Edit User</h2>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                
                <div class="modal-body">
                    <form action="" method="POST" id="edit_form">
                        <label for="UserID">UserID</label>
                        <input type="text" name="UserID" id="modalUserID" class="form-control" readonly>
                        
                        <label for="Username">Username</label>
                        <input type="text" name="Username" id="modalUsername"  class="form-control">

                        <label for="Email">Email</label>
                        <input type="email" name="Email" id="modalEmail"  class="form-control">

                        <label for="Member">Member Type</label>
                        <select name="Member" id="modalMember" class="form-control">
                            <option value="1">Admin</option>
                            <option value="2">Approved</option>
                            <option value="3">Member</option>
                        </select>
                        
                    </form>
                </div>

                <div class="modal-footer">
                    <button form="edit_form" type="submit" id='modalDelete' class="btn btn-secondary" name="delete">Delete User</button>
                    <button form="edit_form" type="submit" id='modalSubmit' class="btn btn-primary" name="submit">Update User</button>
                </div>
            </div>
        </div>
    </div>
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
                <?php elseif($_SESSION['Member'] == 1): ?>
                    <li class="nav-item"><a class="nav-link" href="dashboard.php">Admin Dashboard</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="..\create\CreateGuide.php">Create</a></li>
                    <li class="nav-item"><a class="nav-link" href="..\login\logout.php">Logout</a></li>
                <?php endif ?>
            </ul>
            </div>
        </nav>
        <h1>Admin Dashboard</h1>
        <div id="user_table">
            <table class="table">
                <tr>
                    <th scope="col">Username</th>
                    <th scope="col">UserID</th>
                    <th scope="col">Email</th>
                    <th scope="col">Member Status</th>
                    <th></th>
                </tr>
            <?php foreach($users as $user): ?>
                    <tr id='tr_<?= $user['UserID'] ?>'>
                        <td id="username_<?= $user['UserID'] ?>"><?= $user['Username'] ?></td>
                        <td id="userid_<?= $user['UserID'] ?>"><?= $user['UserID'] ?></td>
                        <td id="email_<?= $user['UserID'] ?>"><?= $user['Email'] ?></td>
                    <?php if($user['Member'] == 1): ?>
                        <td id="member_<?= $user['UserID'] ?>">Admin</td>
                    <?php elseif ($user['Member'] == 2): ?>
                        <td id="member_<?= $user['UserID'] ?>">Approved</td>
                    <?php else: ?>
                        <td id="member_<?= $user['UserID'] ?>">Member</td>
                    <?php endif ?>
                    
                    <td><a href="#userModal" class="edit_link" id="edit_<?= $user['UserID'] ?>" data-toggle="modal" data-target="#userModal" data-id="<?= $user['UserID'] ?>">edit</a></td>
                    
                    <!-- <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#userModal" data-id="<?= $user['UserID'] ?>">Edit User</button></td> -->
                    </tr>
            <?php endforeach ?>
            </table>
        </div>
        <h1>Builds</h1>
        <table class="table">
            <tr>
                <th scope="col">Hero</th>
                <th scope="col">Title</th>
                <th scope="col">Username</th>
            </tr>
            <?php foreach($builds as $build): ?>
            <tr>
                <td>hero name</td>
                <td><a href="..\ViewGuides\viewGuide.php?BuildID=<?= $build['BuildID']?>"><?= $build['Title'] ?></a></td>
                <td><?= $build['Username'] ?></td>
            </tr>
            <?php endforeach ?>
        </table>
    </div>
</body>     
</html>

