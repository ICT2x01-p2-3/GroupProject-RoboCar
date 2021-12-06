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

//Get Details From Previous Form
$name = $_POST['name'];
$difficulty = $_POST['difficulty'];
$points = 0;

//Set Points For Difficulty Level
if ($difficulty == "Easy") {
	$points = 100;
}
if ($difficulty == "Medium") {
	$points = 200;
}
if ($difficulty == "Hard") {
	$points = 300;
}

//Check if name submitted was from scoreboard
$sql = "SELECT * FROM scoreboard WHERE name = '$name'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  $namealreadyexist = 1;
  while($row = $result->fetch_assoc()) {
                            $score = $row["score"];
                            $name = $row["name"];
                            $id = $row["id"];
  }
  $score = $score + $points; //Add the new points
}

if ($namealreadyexist == 1) {
$mysql = "UPDATE scoreboard SET score = '$score' WHERE name = '$name'";
	mysqli_query($conn, $mysql);
} else if ($_POST['name'] != null) {
	$sql = "INSERT INTO scoreboard (name, score) VALUES ('$name', '$points')";
	mysqli_query($conn, $sql);
}
    echo '<script>alert("Redirecting you...")</script>';
    echo "<script>window.location.href = '/UserDashboard.php';</script>";
?>
