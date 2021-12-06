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
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">

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
  <a href="AdminDashboard.php">Home</a>
<a href="PIN.php">PIN</a>
  <a href="Challenges.php" class="active">Challenges</a>
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

   <div class="col-md-6 offset-md-3 mt-5">
        <br>
        <h1>Challenge Validation Completed</h1>

<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageValidate = 0;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image. ";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists. ";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large. ";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed. ";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your challenge was not uploaded. ";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
	$imageValidate = 1;
  } else {
    echo "<p>Sorry, there was an error uploading your file. ";
  }
}

$image = $target_file;
$name = $_POST['ChallengeName'];
$commands = $_POST['Solution'];
$difficulty = $_POST['Difficulty'];

if ($imageValidate == 1) {
    $sql = "INSERT INTO challenges (name, image, commands, difficulty) VALUES ('$name', '$image', '$commands', '$difficulty')";
    //echo $sql; //For Troubleshooting purposes
    if (mysqli_query($conn, $sql)) {
        echo "Challenge added successfully. ";
    } else {
        echo "A Database Error occured. ";
    }
} else {
    echo "An error occured. ";
}
?>

</div>