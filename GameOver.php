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
  <a href="Scoreboard.php">Scoreboard</a>
  <a href="Challenge.php" class="active">Challenge</a>
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

<?php

    $id = $_GET['id'];
	$answer = $_GET['answer'];
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">

   <div class="col-md-6 offset-md-3 mt-5">
        <br>
        <!--<h1>Congratulations! You have completed the challenge!</h1>-->
<?php
//Get Status From Challenge Status
$sql = 'SELECT * FROM challenge_status';
if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $status = $row["status"];
	}
}

//Get Details Of Challenge
$sql = "SELECT * FROM challenges WHERE id = '$id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
$id = $row["id"];
$name = $row["name"];
$image = $row["image"];
$commands = $row["commands"];
$difficulty = $row["difficulty"];
  }
} 
					
//Reset
	$mysql = "UPDATE current_commands SET commands = '' WHERE id = 1";
	mysqli_query($conn, $mysql);
	
	$mysql = "UPDATE challenge_status SET status = '0' WHERE id = 1";
	mysqli_query($conn, $mysql);

//echo $status;
//echo $answer;
$tryagainbutton = '<form action = "VirtualMap.php" method = "POST"><button class="btn btn-success" name = "id" value = "' . $id . '"> Try Again </button></form>';
$highscoreform = '<form enctype="multipart/form-data" action="UpdateScore.php" method="post"><div class="form-group"><label>Name</label><input type="text" name="name" class="form-control" id="name" required="required"><input type="hidden" name="difficulty" id="difficulty" value="' . $difficulty . '"></div><button type="submit" class="btn btn-primary">Submit</button></form></div>';
if ($status == "1" && $answer == "0") {
	echo "<h1>Unfortunately, you did not pass the challenge. Please try again!</h1>";
	echo $tryagainbutton;
} else if ($status == "1" && $answer == "1") {
	echo "<h1>In theory, you would've completed the challenge successfully but in this case, you did not due to some external factors. Please try again!</h1>";
	echo $tryagainbutton;
} else if ($status == "2" && $answer == "1") {
	echo "<h1>Congratulatons, you have completed the challenge successfully!</h1>";
	echo "<p>You may enter your name to be listed on the scoreboard if you wish.</p>";
	echo $highscoreform;
} else if ($status == "2" && $answer == "0") {
	echo "<h1>Wow! You completed the challenge with an unexpected solution!</h1>";
	echo "<p>You may enter your name to be listed on the scoreboard if you wish.</p>";
	echo $highscoreform;
}
?>

<!-- Button For Try Again @ VirtualMap.php -->
<!--
<form action = "VirtualMap.php" method = "POST">
<button class="btn btn-success" name = "id" value = "' . $id . '"> Try Again </button>
</form>
-->

<!-- Form For Scoreboard Update / Used in $highscoreform -->
<!--
        <form enctype="multipart/form-data" action="UpdateScore.php" method="post">
          <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" id="name" required="required">
			<input type="hidden" name="difficulty" id="difficulty" value="">
          </div>
          
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div> 
	-->

    </body>
</html>
