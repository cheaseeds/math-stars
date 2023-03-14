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

    $username = $_POST['uname'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE uname = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);
        
        if (password_verify($password, $user['pword'])) {
            
            $_SESSION['user_id'] = $user['uid'];
            
            header('Location: index.php');
            exit();

            
        } else {
            $error = "Incorrect password";
        }

    } else {
        $error = "User not found";
    }

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
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >

        <h2>Login</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <label>User Name</label>
        <input type="text" name="uname" placeholder="User Name"><br>
        <label>Password</label>
        <input type="password" name="password" placeholder="Password"><br> 
        <button type="submit" name="login" >Login</button>
        <a onclick="location.href='register.php'">Register</a>
        
    </form>
    
    
</html>
