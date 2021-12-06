<?php	

function generatePIN() {

session_start();
// Store data in session variables
if ($_SESSION["role"] != "Admin" && ($_SESSION["logged_in"] = true)) {
    header("location: index.php");
}

	$config = parse_ini_file('./dbconfig.ini');
	$conn = new mysqli($config['dbservername'], $config['dbusername'], $config['dbpassword'], $config['dbname']);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}		
	
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

generatePIN();

?>
