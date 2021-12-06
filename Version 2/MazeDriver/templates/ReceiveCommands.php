<?php
//Ignore PHP Errors
error_reporting(0);
ini_set('display_errors', 0);

$config = parse_ini_file('./dbconfig.ini');
$conn = new mysqli($config['dbservername'], $config['dbusername'], $config['dbpassword'], $config['dbname']);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}		

date_default_timezone_set('Asia/Singapore');
$datetime = date('Y-m-d H:i:s');

//Sample: http://192.168.134.202/ReceiveCommands.php?Connectivity=1&ObjectDetectedDistance=1&Speed=1
if ($_GET["Connectivity"] != null) {
	
$Connectivity = $_GET["Connectivity"];
$ObjectDetectedDistance = $_GET["ObjectDetectedDistance"];
$Speed = $_GET["Speed"];
	
	$sql = "UPDATE car_status SET connectivity = '$Connectivity' , objectDistance = '$ObjectDetectedDistance' , speed = '$Speed' , datetime = '$datetime'" . "WHERE id = 1";
	
	if (mysqli_query($conn, $sql)) {
	//echo "done";
 } else {
     $errorMsg = "Database error: " . $conn->error;
     $errorMsg = "Execute failed: (" . $sql->errno . ") " . $sql->error;
     echo '<script>console.log("' . $errorMsg . '")</script>';
 }
	
}

//Sample: http://192.168.134.202/ReceiveCommands.php?CompleteChallenge=1
if ($_GET["CompleteChallenge"] != null) {
	
$status = $_GET["CompleteChallenge"];
	
	$sql = "UPDATE challenge_status SET status = '$status'" . "WHERE id = 1";
	
	if (mysqli_query($conn, $sql)) {
	//echo "done";
 } else {
     $errorMsg = "Database error: " . $conn->error;
     $errorMsg = "Execute failed: (" . $sql->errno . ") " . $sql->error;
     echo '<script>console.log("' . $errorMsg . '")</script>';
 }
	
}

//Constant Check Function For DoChallenge.php
if(isset($_POST['state'])){
  //query database
  $sql = 'SELECT * FROM challenge_status';
                    if ($result = $conn->query($sql)) {
                        while ($row = $result->fetch_assoc()) {
                            $status = $row["status"];
							echo $status;
						}
					}
  
  //depending on returned result
  echo 'something'; //this something will be read in your JS code above and act accordingly
}

//This to be removed when Car Is Functioning
 $sql = 'SELECT * FROM challenge_status';
                    if ($result = $conn->query($sql)) {
                        while ($row = $result->fetch_assoc()) {
                            $status = $row["status"];
							echo $status;
						}
					}

?>