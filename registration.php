<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
    require('connection.php');
    // When form submitted, insert values into the database.
   
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        
        //escapes special characters in a string
        $username = mysqli_real_escape_string($con,  trim($_POST["username"]));
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con,  trim($_POST["email"]));
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con,  trim($_POST["password"]));
        $create_datetime = date("Y-m-d H:i:s");
         $sql = "SELECT * FROM `users` WHERE username='$username' OR email = '$email'";
        $res = mysqli_query($con, $sql) or die(mysql_error());
        $rows = mysqli_num_rows($res);
        
        if ($rows >= 1) { 
            echo "<div class='form'>
                  <h3>You are already a member.</h3><br/>
                  <p class='link'>Click here to <a href='index.php'>Login</a></p>
                  </div>";
        }else{
        $query    = "INSERT into `users` (username, password, email, create_datetime)
                     VALUES ('$username', '" . md5($password) . "', '$email', '$create_datetime')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='index.php'>Login</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>";
        }
    }
    }else {
?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" required />
        <input type="email" class="login-input" name="email" placeholder="Email Address" required>
        <input type="password" class="login-input" name="password" placeholder="Password" required>
        <input type="submit" name="submit" value="Register" class="login-button" >
        <p class="link">Already have an account? <a href="index.php">Login here</a></p>
    </form>
<?php
    }
?>
</body>
</html>
