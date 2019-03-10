<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
</head>
<body>
    <form action="process_create.php" method="post">

        <label for="username">Username: </label>
        <input type="text" id="name" name="username">

        <label for="password">Password: </label>
        <input type="text" id="password" name="password">

        <label for="email">Email: </label>
        <input type="email" id="email" name="email">

        <button type="submit">Submit</button>
    </form>
</body>
</html>