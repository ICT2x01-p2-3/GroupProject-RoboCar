
<?php
// Initialize the session
session_start();
// Verify session
if ($_SESSION["role"] != "Admin" && ($_SESSION["logged_in"] == true)) {
    header("location: index.php");
}
if ($_SESSION["logged_in"] != true) {
    header("location: index.php");
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
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
</head>
<body>

<!-- Navigation Bar -->
<div class="topnav" id="myTopnav">
  <a href="AdminDashboard.php" class="active">Home</a>
<a href="PIN.php">PIN</a>
  <a href="Challenges.php">Challenges</a>
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
//SQL Connection
$config = parse_ini_file('./dbconfig.ini');
$conn = new mysqli($config['dbservername'], $config['dbusername'], $config['dbpassword'], $config['dbname']);

// Check SQL Connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = 'SELECT * FROM car_status';
                    if ($result = $conn->query($sql)) {
                        while ($row = $result->fetch_assoc()) {
                            $connectivity = $row["connectivity"];
                            $objectDistance = $row["objectDistance"] . " cm";
                            $speed = $row["speed"] . " KM/H";
                            $datetime = $row["datetime"];
						}
					}
					
date_default_timezone_set('Asia/Singapore');
$currentdatetime = date('Y-m-d H:i:s');
$timeDatabase = strtotime($datetime);
$timeNow = strtotime($currentdatetime);  
$timeDiff = $timeNow - $timeDatabase;
//echo $timeDiff; //Seconds

if ($timeDiff <= 30) {
	$connectivityInfo = "Stable / Connected";
} else if ($timeDiff > 30 && $timeDiff <= 90) {
	$connectivityInfo = "Unstable / Connecting";
} else if ($timeDiff > 90) {
	$connectivityInfo = "Disconnected";
	$objectDistance = "NIL";
	$speed = "NIL";
}

?>

<div style="padding-left:16px">
  <h2>Admin Dashboard</h2>
  <p>Welcome to P2-3's 2X01 Web Server</p>
  <p>Here's some details about our car!</p>
</div>


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<div class="col-sm-12">
<div class="row">
        <div class="col-sm-3">
          <div class="well">
            <h4>Connectivity</h4>
            <p><?php echo $connectivityInfo; ?></p> 
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h4>Last Object Distance Detection</h4>
            <p><?php echo $objectDistance; ?></p> 
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h4>Speed</h4>
            <p><?php echo $speed; ?></p> 
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h4>Last Updated</h4>
            <p><?php echo $datetime; ?></p> 
          </div>
        </div>
</div>

</body>
</html>