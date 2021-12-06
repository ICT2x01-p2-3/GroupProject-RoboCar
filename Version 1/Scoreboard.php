<?php
// Initialize the session
session_start();

//Hide PHP Errors
error_reporting(0);
ini_set('display_errors', 0);

// Verify session
if ($_SESSION["role"] == "Admin" && ($_SESSION["logged_in"] == true)) {
    header("location: AdminDashboard.php");
}
if ($_SESSION["logged_in"] != true) {
    header("location: index.php");
}

//SQL Connection
$config = parse_ini_file('./dbconfig.ini');
$conn = new mysqli($config['dbservername'], $config['dbusername'], $config['dbpassword'], $config['dbname']);

// Check SQL Connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html>
<body>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>

body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #333;
  
}

.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
  
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #04AA6D;
  color: white;
}

.topnav .icon {
  display: none;
}

@media screen and (max-width: 600px) {
  .topnav a:not(:first-child) {display: none;}
  .topnav a.icon {
    float: right;
    display: block;
  }
}

@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
	
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
	
  }
}
</style>

<!-- Navigation Bar -->
<div class="topnav" id="myTopnav">
  <a href="UserDashboard.php">Home</a>
  <a href="Scoreboard.php" class="active">Scoreboard</a>
  <a href="Challenge.php">Challenge</a>
   <a href="logout.php">Log Out</a>

  <a href="javascript:void(0);" class="icon" onclick="navBarFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>

<script>
function navBarFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>
<!-- End Of Navigation Bar -->

<!-- Apply Bootstrap CSS After Above Content Loaded For Table -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
<style>.table{
   width:95%;
   table-layout: auto;
   overflow-wrap: break-word;
   border-collapse: collapse;
     border-spacing: 0;
}</style>

            <table class = "table" align="center">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Score</th>
                    </tr>
                </thead>
                <tbody id="table">
                    <?php
                    $sql = 'SELECT * FROM scoreboard ORDER BY score DESC';
                    if ($result = $conn->query($sql)) {
                        while ($row = $result->fetch_assoc()) {
                            $id = $row["id"];
                            $name = $row["name"];
                            $score = $row["score"];

                            echo '<tr>
                    <td>' . $name . '</td>
					<td>' . $score . '</td> 
                        </tr>';
                        }
                    } else {
                        echo '<script>alert("0 Results Retrieved!")</script>';
                    }
                    ?>

                </tbody>
            </table>
        </div>

    </body>
</html>
