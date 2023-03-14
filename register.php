<?php

session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "math_stars_users";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
	die("Failed to connect to MySQL: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = !empty($_POST['username']) ? $_POST['username'] : null;
    $password = !empty($_POST['password']) ? $_POST['password'] : null;
    $first_name = !empty($_POST['first_name']) ? $_POST['first_name'] : null;
    $last_name = !empty($_POST['last_name']) ? $_POST['last_name'] : null;
    $email_address = !empty($_POST['email_address']) ? $_POST['email_address'] : null;

    if (!$username || !$password || !$first_name || !$last_name || !$email_address) {
        $error = "All fields are required";
    } else {
        $result = mysqli_query($conn, "SELECT * FROM users WHERE uname = '$username'");
        if (mysqli_num_rows($result) == 1) {
            $error = "Username already exists!";
            header("Location: register.php?error=$error"); 
            exit();
        } else {

            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (uname, pword, user_first_name, user_last_name, email_address) VALUES ('$username', '$password', '$first_name', '$last_name', '$email_address')";

        }
        if (mysqli_query($conn, $sql)) {
            header("Location: login.php"); 
            exit();
        } else {
            $error = "Error: " . mysqli_error($conn);
            header("Location: register.php?error=$error"); 
            exit();
        }
    }
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
            <p><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <?php if (!empty($error)) { ?>
            <p><?php echo $error; ?></p>
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
        <a onclick="location.href='login.php'">Back to Login</a>
        
    </form>
    

</html>
