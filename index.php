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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <title>Mathnasium Stars</title>
        <style>
            * {
                font-family: 'Roboto', sans-serif;
            }
            h1 {
                
                text-align: center;
                font-size: 2rem;
                padding: 30px;
                background-color: red;
                color: white;
                border: 0;
                margin: 0;
            }
            h2 {
                margin: 10px;
            }
            body {
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
            #desc {
                margin: 10px;
            }
            #table-title {
                text-align: center;
            }
            input {
                width: 50%;
            }
            input:focus {
                background-color: lightblue;
            }
            form {
                margin: 20px;
            }
            .row:after {
                content: "";
                display: table;
                clear: both;
            }
            {
                box-sizing: content-box;
            }
            .column-buttons {
                float: left;
                width: 30%;
                background-color:#d4cecd; 
                height:100vh;
            }

            .column-table {
                float: right;
                width: 70%;                
                background-color:#e8e4e3; 
                height: 100vh
            }
            th {
                font-size: 1.5rem;
            }
            
        </style>
</head>

<body>
    <header>
        <h1>Math Stars</h1>
    </header>
    <p style="color: white; background-color: red; border: 0; margin: 0" >
        This is just a testing page for the different functions being implemented!!!
    </p>
    
    <!--
    Form for reading student data providing it with an input type of "number" and a button
    -->
    
    
    <div class="row">
        <div class="column-buttons">
            <h2>Read Student Data</h2>
            <form method="post" action="call_routine.php">
                <input type="hidden" name="routine" value="read_student">
                <input type="number" name="s_idx" id="s_idx" min="0" max="99999999999" placeholder="Student index">
                <br>
                <button type="submit">Submit</button>
            </form>
            <p id="desc">Read student data with their index.</p>
            <br>
            
            <h2>Display All Student Data</h2>        
            <form method="post" action="call_routine.php">
                <input type="hidden" name="routine" value="read_all_student">
                <button type="submit">Display</button>
            </form>
            <p id="desc">Click to display all student data.</p>
            <br>

            <h2>Update Student Data</h2>       
            <form method="post" action="call_routine.php">
                <input type="hidden" name="routine" value="update_student">
                <input type="number" name="s_u_idx" id="s_u_idx" min="0" max="99999999999" placeholder="Student index">
                <br>
                <input type="text" name="s_u_first_name" id="s_u_first_name"maxlength="255"  placeholder="First Name">
                <br>
                <input type="text" name="s_u_last_name" id="s_u_last_name" maxlength="255" placeholder="Last Name">
                <br>
                <input type="number" name="s_u_star_num" id="s_u_star_num" min="0" max="99999999999" placeholder="Number of Stars">
                <br>
                <button type="submit">Submit</button>
            </form>
            <p id="desc">Use a student's index to update their name and number of stars.</p>
            <br>
            
            <h2>Add a Student</h2> 
            <form method="post" action="call_routine.php">
                <input type="hidden" name="routine" value="add_student">
                <input type="text" name="s_c_first_name" id="s_c_first_name" maxlength="255" placeholder="First Name">
                <br>
                <input type="text" name="s_c_last_name" id="s_c_last_name" maxlength="255" placeholder="Last Name">
                <br>
                <input type="number" name="s_c_star_num" id="s_c_star_num" min="0" max="99999999999" placeholder="Number of Stars">
                <br>
                <button type="submit">Submit</button>
                <br>
                <br>
            </form>
            <p id="desc">Add a student using their name and number of stars to receive.</p>

            <h2>Delete a Student</h2>
            <form method="post" action="call_routine.php">
                <input type="hidden" name="routine" value="delete_student">
                <input type="number" name="s_d_idx" id="s_d_idx" min="0" max="99999999999" placeholder="Student index">
                <br>
                <button type="submit">Submit</button>
            </form> 
            <p id="desc">Use a student's index to delete them.</p>
            
        </div>
      
        <div class="column-table">
            <h2 id="table-title">Student Information</h2>
            <table style="width: 85%"> 
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

    <footer style="color: white; text-align: right; background-color: black; margin: 0; border: 0">
    <br><br><br>Alex Chea 2023</footer>
</body>


