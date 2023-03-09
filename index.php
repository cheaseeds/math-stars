<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "math_stars";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
	die("Failed to connect to MySQL: " . mysqli_connect_error());
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Mathnasium Stars</title>
        <style>
            h1 {
                text-align: center;
                font-size: 2rem;
                margin: auto;
            }
            button {
                cursor: pointer;
            }
            td {
                text-align: center;
            }
            p {
                color: blue;
                margin: auto;
            }
        </style>
</head>

<body>
    <header>
        <h1>Math Stars</h1>
    </header>
    <p style="color: red">
        This is just a testing page for the different functions being implemented!!!
    </p>
    <!--
    Form for reading student data providing it with an input type of "number" and a button
    -->
    <br>
    <br>
    <h2>Read Student Data</h2>
    <form method="post" action="call_routine.php">
        <input type="hidden" name="routine" value="read_student">
        <input type="number" name="s_idx" id="s_idx" min="0" max="99999999999" placeholder="Student index">
        <button type="submit">Submit</button>
	</form>
    <p>Read student data with their index.</p>
    <br>
    
    <h2>Display All Student Data</h2>        
    <form method="post" action="call_routine.php">
        <input type="hidden" name="routine" value="read_all_student">
        <button type="submit">Display</button>
	</form>
    <p>Click to display all student data.</p>
    <br>

    <h2>Update Student Data</h2>       
    <form method="post" action="call_routine.php">
        <input type="hidden" name="routine" value="update_student">
        <input type="number" name="s_u_idx" id="s_u_idx" min="0" max="99999999999" placeholder="Student index">
        <br>
        <input type="text" name="s_first_name" id="s_first_name"maxlength="255"  placeholder="First Name">
        <br>
        <input type="text" name="s_last_name" id="s_last_name" maxlength="255" placeholder="Last Name">
        <br>
        <input type="number" name="s_star_num" id="s_star_num" min="0" max="99999999999" placeholder="Number of Stars">
        <br>
        <button type="submit">Submit</button>
	</form>
    <p>Use a student's index to update their name and number of stars.</p>
    <br>
    <br>
    
    <h2>Create a Student</h2> 
    <form method="post" action="call_routine.php">
    <input type="hidden" name="routine" value="create_student">
    <input type="text" name="s_first_name" id="s_first_name" maxlength="255" placeholder="First Name">
    <br>
    <input type="text" name="s_last_name" id="s_last_name" maxlength="255" placeholder="Last Name">
    <br>
    <input type="number" name="s_star_num" id="s_star_num" min="0" max="99999999999" placeholder="Number of Stars">
    <br>
    <button type="submit">Submit</button>
    <br>
    </form>
</body>

<table style="width: 50rem"> 
    <caption style="font-weight: bold; font-size: 20px; text-align: auto">Student Information</caption>
    <thead>
        <tr>
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
                    echo "<td>" . $student['uid'] . "</td>";
                    echo "<td>" . $student['Name'] . "</td>";
                    echo "<td>" . $student['Stars'] . "</td>";
                    echo "</tr>";
                }
            }
        ?>
    </tbody>
</table>
