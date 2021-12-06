<?php
// Initialize the session
session_start();

//Hide PHP Errors
error_reporting(0);
ini_set('display_errors', 0);

// Verify session
if ($_SESSION["role"] == "Student" && ($_SESSION["logged_in"] == true)) {
    header("location: UserDashboard.php");
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

$sql = "SELECT image FROM challenges WHERE id = '$id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $image = $row["image"];
	echo $image;
  }
} 




if (isset($_POST['delete'])) {

    $id = $_POST['delete'];
	
	$sql = "SELECT image FROM challenges WHERE id = '$id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $image = $row["image"];
	echo $image;
  }
} 

    $mysql = "DELETE FROM challenges WHERE id='$id'";
    //echo $mysql;
    if ($conn->query($mysql) === true) {
        echo '<script>alert("Challenge Deleted")</script>';
		unlink($image);
        echo '<script>history.back();</script>';
    } else {
        echo '<script>alert("Delete Record Failed.")</script>';
        echo '<script>history.back();</script>';
        //echo "Error deleting record: " . $conn->error;
    }
}
?>


