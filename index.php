<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "math_stars";
//$userdbname = "math_stars_users";
$conn = mysqli_connect($servername, $username, $password, $dbname);

/**
 * TODO: bind my statements for security against SQL injections
 */


/**
 * connects to the user database
 * queries the database for the user that we logged in with
 */
/*mysqli_select_db($conn, $userdbname);
$user_id = $_SESSION['user_id'];
$query = "SELECT user_first_name FROM users WHERE uid = '$user_id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$user_first_name = $row['user_first_name'];*/

if (!$conn) {
	die("Failed to connect to MySQL: " . mysqli_connect_error());
}

/**
 * connects to the information database
 * queries the database for the information associated with the user
 */
mysqli_select_db($conn, $dbname);
$result = mysqli_query($conn, "SELECT `idx`, `uid`, CONCAT(`first_name`, ' ', `last_name`) AS `Name`, `star_num` AS `Stars` FROM student");
        if (mysqli_num_rows($result) > 0) {
                $students = array();
                while ($row = mysqli_fetch_assoc($result)) {
                    $students[] = $row;        
                }
                
                
                
        } else {
            echo "Empty database";
            echo '<br><br>';
            echo '<button onclick="location.href=\'index.php\';">Go back</button>';
        }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <link rel="stylesheet" href="tablesorter-master/tablesorter-master/dist/css/theme.default.min.css">
    <link rel="stylesheet" type="text/css" href="styles/index-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <title>Mathnasium Stars</title>
        <style>
            
        </style>
    </head>

<body>
    <header>
        
        <a style="opacity: 1" onclick="location.href='index.php'"><h1>Math Stars</h1></a>
        <nav>
            <a id="logout" onclick="location.href='logout.php'">Logout</a>
            <!--<p style="color: white; background-color: red; border: 0; margin: 0; font-size: 1.75rem" >
              Logged in as
            </p>-->
        </nav> 
    </header>

    
   
    
    <div class="row">
        <div class="container">
            <div class="column-buttons">
                <!--
                <div class="form-container">
                    <h2>Read Student Data</h2>
                    <form method="post" action="call_routine.php">
                        <input type="hidden" name="routine" value="read_student">
                        <input type="number" name="s_idx" id="s_idx" min="0" max="99999999999" placeholder="Student index">
                        
                        <button class="button-47" type="submit">Submit</button>
                    </form>
                </div>
            
                <br>
                
                <div class="form-container">
                    <h2>Display All Student Data</h2>        
                    <form method="post" action="call_routine.php">
                        <input type="hidden" name="routine" value="read_all_student">
                        
                        <button class="button-47" type="submit">Display</button>
                    </form>
                </div>
                
                <br>
                -->
                <div class="form-container">
                    <h2>Update Student Data</h2>       
                    <form method="post" action="call_routine.php">
                        <input type="hidden" name="routine" value="update_student">
                        <input type="number" name="s_u_idx" id="s_u_idx" min="0" max="99999999999" placeholder="Student index">
                        
                        <input type="text" name="s_u_first_name" id="s_u_first_name"maxlength="255"  placeholder="First Name">
                        
                        <input type="text" name="s_u_last_name" id="s_u_last_name" maxlength="255" placeholder="Last Name">
                        
                        <input type="number" name="s_u_star_num" id="s_u_star_num" min="0" max="99999999999" placeholder="Number of Stars">
                        
                        <button class="button-47" type="submit">Submit</button>
                    </form>
                </div>
                
                <br>
                
                <div class="form-container">
                    <h2>Add a Student</h2> 
                    <form method="post" action="call_routine.php">
                        <input type="hidden" name="routine" value="add_student">
                        <input type="text" name="s_c_first_name" id="s_c_first_name" maxlength="255" placeholder="First Name">
                        
                        <input type="text" name="s_c_last_name" id="s_c_last_name" maxlength="255" placeholder="Last Name">
                        
                        <input type="number" name="s_c_star_num" id="s_c_star_num" min="0" max="99999999999" placeholder="Number of Stars">
                        
                        <button class="button-47" type="submit">Submit</button>
                        
                    </form>
                </div>
            
                <br>

                <div class="form-container">
                    <h2>Delete a Student</h2>
                    <form method="post" action="call_routine.php">
                        <input type="hidden" name="routine" value="delete_student">
                        <input type="number" name="s_d_idx" id="s_d_idx" min="0" max="99999999999" placeholder="Student index">
                        
                        <button class="button-47" type="submit">Submit</button>
                    </form> 
                </div>        
            </div>
            <div class="column-table">  
                <h2 id="table-title">Student Information</h2>             
                <table id="my-table" class="tablesorter"> 
                    <thead>
                        <tr>
                            <th>Index</th>
                            <th>UID</th>
                            <th>Name</th>
                            <th>Stars</th>
                        </tr>
                    </thead> 
                    <tbody>
                        <?php
                            if (isset($students)) {
                                foreach ($students as $student) {
                                    echo "<tr>";
                                    echo "<td>" . $student['idx'] . "</td>";
                                    echo "<td>" . $student['uid'] . "</td>";
                                    echo "<td>" . $student['Name'] . "</td>";
                                    echo "<td>" . $student['Stars'] . "</td>";
                                    echo "</tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>       
        </div>
    </div> 
    
    <footer>
        <nav>
            <a href="https://github.com/cheaseeds/math-stars"><img src="images/github.png"></a>
        </nav>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="tablesorter-master/tablesorter-master/dist/js/jquery.tablesorter.min.js"></script>
    <script>
        $(function() {
            $("#my-table").tablesorter();
        });
    </script>
</body>



