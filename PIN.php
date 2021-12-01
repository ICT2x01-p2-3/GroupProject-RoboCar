
<?php
session_start();
// Store data in session variables
if ($_SESSION["role"] != "Admin" && ($_SESSION["logged_in"] = true)) {
    header("location: index.php");
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PIN</title>
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
  <a href="AdminDashboard.php">Home</a>
<a href="PIN.php" class="active">PIN</a>
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
	$config = parse_ini_file('./dbconfig.ini');
	$conn = new mysqli($config['dbservername'], $config['dbusername'], $config['dbpassword'], $config['dbname']);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//Obtain last known PIN from database
global $dateime, $pin;
                    $sql = "SELECT * FROM pin WHERE id = 1";
                    if ($result = $conn->query($sql)) {
                        while ($row = $result->fetch_assoc()) {
                            $datetime = $row["datetime"];
                            $pin = $row["pin"];
						}
					}

					

function generatePIN() {
$six_digit_random_number = random_int(100000, 999999);
//echo $six_digit_random_number;
//Logging
date_default_timezone_set('Asia/Singapore');
$datetime = date('Y-m-d H:i:s');

$sql = "UPDATE pin SET pin = '$six_digit_random_number' , datetime = '$datetime'" . "WHERE id = 1";
if (mysqli_query($conn, $sql)) {
     header("location: PIN.php");
 } else {
     $errorMsg = "Database error: " . $conn->error;
     $errorMsg = "Execute failed: (" . $sql->errno . ") " . $sql->error;
     echo "An Error Occured";
     echo '<script>console.log("' . $errorMsg . '")</script>';
 }
 $sql->close();
}

function displayPIN() {
	global $pin, $datetime;
	echo '<h2>PIN: ' . $pin . '</h2>';
	echo '<p>This PIN was last generated on ' . $datetime . '. Please click <a href="generatePIN.php">here</a>.</p>';
}

?>
					<div style="padding-left:16px">
						<?php displayPIN(); ?>
					</div>
				</body>
			</html>