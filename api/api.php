<?php
	$config = parse_ini_file('./dbconfig.ini');
	$conn = new mysqli($config['dbservername'], $config['dbusername'], $config['dbpassword'], $config['dbname']);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$id=$_GET["id"];
$sql = "SELECT command FROM api WHERE id=$id";
//echo $sql;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo $row["command"];
  }
} else {
  echo "No results found";
}
$conn->close();

            ?>
			