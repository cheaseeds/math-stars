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
            {
                box-sizing: content-box;
            }
                /* Set additional styling options for the columns*/
            .column-table {
                float: left;
                width: 30%;
            }

            .column-buttons {
                float: right;
                width: 70%;
            }

            .column-head{
                text-align: center;
                font-size: 2rem;
            }

            .row:after {
                content: "";
                display: table;
                clear: both;
            }

            #column-table-data {
                text-align: center;
            }
            #column-button-data {
                text-align: center;
            }
        </style>
</head>

<body>
    <header>
        <h1>Math Stars</h1>
    </header>
    <p style="color: red">
        This is just a testing page for the different tests being implemented!!!
    </p>
    <div class="row">
        <div class="column-table" style="background-color:#FFB695; min-height:100vh">
            <h2 class="column-head">Column 1</h2>
            <p id="column-table-data">I got a table here</p>
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
        </div>
        <div class="column-buttons" style="background-color:#96D1CD; min-height:100vh">
            <h2 class="column-head">Column 2</h2>
            <p id="column-button-data">I got some buttons here</p>
            
        </div>
    </div>
</body>