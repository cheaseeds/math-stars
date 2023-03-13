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
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="styles/login-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <header>
        <h1>
            Math Stars
        </h1>
    </header>
    <form action="register.php" method="post">

        <h2>Register</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <label>User Name</label>
        <input type="text" name="username" placeholder="User Name"><br>
        <label>Password</label>
        <input type="password" name="password" placeholder="Password"><br>
        <label>First Name</label>
        <input type="text" name="first_name" placeholder="First Name"><br> 
        <label>Last Name</label>
        <input type="text" name="last_name" placeholder="Last Name"><br> 
        <label>Email Address</label>
        <input type="text" name="email_address" placeholder="Email Address"><br>  
        <button type="submit">Register</button>

    </form>

</html>
