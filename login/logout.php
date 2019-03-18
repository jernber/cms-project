<?php
    session_start();
    session_destroy(); 
    echo 'You have been logged out. You will be sent back to the homepage in 5 seconds... Click <a href="../index.php">here</a> to go back to the home page';
    header('Refresh:5 url=..\index.php');
?>