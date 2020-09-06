<?php
//include auth_session.php file on all user panel pages
session_start();
    if(!isset($_SESSION["username"])) {
        header("Location: index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registration</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <div class="form">
        <p>Hii, <?php echo $_SESSION['username']; ?>!</p>
        <p>You logged in successfully.</p>
        <p><a href="logout.php">Logout</a></p>
    </div>
</body>
</html>
