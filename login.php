<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
	die("Failed to connect to MySQL: " . mysqli_connect_error());
}

?>
<!DOCTYPE html>
<html>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="styles/login-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <header>
        <h1>
            Math Stars
        </h1>
    </header>
    <form action="login.php" method="post">

        <h2>Login</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <label>User Name</label>
        <input type="text" name="uname" placeholder="User Name"><br>
        <label>Password</label>
        <input type="password" name="password" placeholder="Password"><br> 
        <button type="submit">Login</button>
        <a onclick="location.href='register.php'">Register</a>
        

    </form>
    
    
        

    </html>
