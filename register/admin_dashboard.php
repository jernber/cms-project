<?php
    require('requires\connect.php');
    $query = "SELECT * FROM cms_users";
    $statement = $db->prepare($query);
    $statement->execute();

    
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
</head>
<body>
    <h1>Users</h1>
    <table class="users">
        <tr>
            <th>Username</th>
            <th>Status</th>
            <th>Email</th>
        </tr>
        
        <tr>
        <?php while($users = $statement->fetch()): ?>
        <td><?= $users['Username'] ?></td>

        <?php if($users['Member'] == 1 ): ?>
            <td>Member</td>
        <?php endif ?>
        
        <td><?= $users['Email'] ?></td>
        
        </tr>
        <?php endwhile ?>
    </table>

</body>
</html>