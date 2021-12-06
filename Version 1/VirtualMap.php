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

    $id = $_POST['id'];
	
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

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">

   <div class="col-md-6 offset-md-3 mt-5">
        <br>
        <h1></h1>
        <form enctype="multipart/form-data" action="DoChallenge.php" method="post">
          <div class="form-group">
            <label>Challenge Name</label>
            <input type="text" name="ChallengeNameInfo" class="form-control" value="<?php echo $name; ?>" id="ChallengeNameInfo" placeholder="Enter Challenge's Name" required="required" readonly>
          </div>
          <div class="form-group">
            <label>Difficulty Level</label>
            <input type="text" name="DifficultyInfo" class="form-control" value="<?php echo $difficulty; ?>" id="DifficultyInfo" required="required" readonly>
          </div>
          <div class="form-group">
            <label required="required">Commands To Execute</label>
            <input type="text" name="Solution" class="form-control" id="Solution" placeholder="Enter commands for the car to execute here" readonly/>
          </div>
		  <input type="button" class="btn btn-light" value="Move Forward" name="PressForwardButton" onclick="PressForward()"></button>
		  <input type="button" class="btn btn-light" value="Turn Right" name="PressRightButton" onclick="PressRight()"></button>
		  <input type="button" class="btn btn-light" value="Turn Left" name="PressLeftButton" onclick="PressLeft()"></button>
		  <input type="button" class="btn btn-light" value="Clear" name="PressClearButton" onclick="PressClear()"></button>
<script>
function PressRight() {
document.getElementById("Solution").value+= 'Right ';
}
function PressLeft() {
document.getElementById("Solution").value+= 'Left ';
}
function PressForward() {
document.getElementById("Solution").value+= 'Forward ';
}
function PressClear() {
document.getElementById("Solution").value= '';
}
</script>

		  <p><input name="id" type="hidden" value="<?php echo $id ?>" /></p>
          <hr>
		  <img src="<?php echo $image; ?>" width=100%>
          <hr>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div> 

    </body>
</html>
