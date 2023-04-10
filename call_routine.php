<?php

//if there is no session, start one
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//if there is no user_id set, send them back to the login page
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "math_stars";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
	die("Failed to connect to MySQL: " . mysqli_connect_error());
}


// form data is submitted with the name=routine, action=call_routine.php and a value
// sends the data here 
if (isset($_POST['routine'])) {
    $routine = $_POST['routine'];

    // READ_STUDENT NOT IN USE!!!
    /*if ($routine == "read_student") {
        if (isset($_POST['s_idx'])) {
            
            $s_idx = $_POST['s_idx'];
            if ($s_idx == "") {
                echo "This field can't be empty.";
                echo '<br><br>';
                echo '<button onclick="location.href=\'index.php\';">Go back</button>';
                exit();
            }
            $result = mysqli_query($conn, "CALL read_student($s_idx)");

            if (mysqli_num_rows($result) > 0) { // checks if the result has a row
                $students = array();  // makes an empty array
                
                while ($row = mysqli_fetch_assoc($result)) { // gets one row of data
                    $students[] = $row; // appends student with the row of data
                }
                
                include 'index.php';
            
            } else {
                echo "Error: No student found at index $s_idx.";
                echo '<br><br>';
                echo '<button onclick="location.href=\'index.php\';">Go back</button>';
            }
        } else {
            echo "Error: Student ID is required.";
        }
    } 
    // READ_ALL_STUDENT NOT IN USE!!!
    else if ($routine == "read_all_student") {
        $result = mysqli_query($conn, "CALL read_all_student()");
        if (mysqli_num_rows($result) > 0) {
                $students = array();
                while ($row = mysqli_fetch_assoc($result)) {
                    $students[] = $row;
                }
                
                include 'index.php';
                
        } else {
            echo "Empty database";
            echo '<br><br>';
            echo '<button onclick="location.href=\'index.php\';">Go back</button>';
        }
    } */
    // UPDATE_STUDENT
    if ($routine == "update_student") {
        if (isset($_POST['s_u_idx'])) {
            $s_u_idx = $_POST['s_u_idx'];

            $result = mysqli_query($conn, "SELECT * FROM `student` WHERE idx = $s_u_idx");
            if (mysqli_num_rows($result) > 0) { //checks if we were able to find a student with that index

                $s_u_first_name = $_POST['s_u_first_name'];
                $s_u_last_name = $_POST['s_u_last_name'];
                $s_u_star_num = $_POST['s_u_star_num'];

                $result = mysqli_query($conn, "CALL update_student($s_u_idx, '$s_u_first_name', '$s_u_last_name', $s_u_star_num)");
                if ($result) {
                    
                    header("Location: index.php");
                    exit();
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            } else {
                echo "Student with the following index was not found.";
                echo '<br>';
                echo '<button onclick="location.href=\'index.php\';">Go back</button>';
            }

        }

    }
    // ADD_STUDENT 
    else if ($routine == "add_student") {
        if (isset($_POST['s_c_first_name']) && isset($_POST['s_c_last_name']) && isset($_POST['s_c_star_num'])) {
            $s_c_first_name = $_POST['s_c_first_name'];
            $s_c_last_name = $_POST['s_c_last_name'];
            $s_c_star_num = $_POST['s_c_star_num'];

            $result = mysqli_query($conn, "CALL add_student('$s_c_first_name', '$s_c_last_name', $s_c_star_num)");
            if ($result) {    
                header("Location: index.php");
                echo '<button onclick="location.href=\'index.php\';">Go back</button>';
                exit();
            }
        }
    }

    // DELETE_STUDENT
    else if ($routine == "delete_student") {
        $s_d_idx = $_POST['s_d_idx'];
        $result = mysqli_query($conn, "CALL delete_student($s_d_idx)");

        if ($result) {    
            header("Location: index.php");
            echo '<button onclick="location.href=\'index.php\';">Go back</button>';
            exit();
        }
    }
}

mysqli_close($conn);
?>