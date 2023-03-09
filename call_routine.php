<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "math_stars";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
	die("Failed to connect to MySQL: " . mysqli_connect_error());
}

if (isset($_POST['routine'])) {
    $routine = $_POST['routine'];

    // READ_STUDENT
    if ($routine == "read_student") {
        if (isset($_POST['s_idx'])) {
            
            $s_idx = $_POST['s_idx'];
            if ($s_idx == "") {
                echo "This field can't be empty.";
                echo '<br><br>';
                echo '<button onclick="location.href=\'index.php\';">Go back</button>';
                exit();
            }
            $result = mysqli_query($conn, "CALL read_student($s_idx)");

            if (mysqli_num_rows($result) > 0) {
                $students = array();
                while ($row = mysqli_fetch_assoc($result)) {
                    $students[] = $row;
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
    // READ_ALL_STUDENT
    else if ($routine == "read_all_student") {
        $result = mysqli_query($conn, "CALL read_all_student()");
        if (mysqli_num_rows($result) > 0) {
                $students = array();
                while ($row = mysqli_fetch_assoc($result)) {
                    $students[] = $row;
                }

                include 'index.php';
            }
    } 
    // UPDATE_STUDENT
    else if ($routine == "update_student") {
        if (isset($_POST['s_u_idx'])) {
            $s_u_idx = $_POST['s_u_idx'];

            $result = mysqli_query($conn, "SELECT * FROM `student` WHERE idx = $s_u_idx");
            if (mysqli_num_rows($result) > 0) { //checks if we were able to find a student with that index

                $s_first_name = $_POST['s_first_name'];
                $s_last_name = $_POST['s_last_name'];
                $s_star_num = $_POST['s_star_num'];

                $result = mysqli_query($conn, "CALL update_student($s_u_idx, '$s_first_name', '$s_last_name', $s_star_num)");
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
    // DELETE_STUDENT ***NOT IMPLEMENTED***
    else if ($routine == "delete_student") {
        $s_idx = $_POST['s_idx'];
        $result = mysqli_query($conn, "CALL delete_student($s_idx,)") or die("Error");

        echo '<button onclick="location.href=\'index.php\';">Go back</button>';
    }
}

mysqli_close($conn);
?>