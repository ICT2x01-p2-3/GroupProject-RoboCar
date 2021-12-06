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
	$solution = $_POST['Solution'];
	
	$mysql = "UPDATE current_commands SET commands = '$solution' WHERE id = 1";
	mysqli_query($conn, $mysql);
	
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

if ($solution == $commands) {
	$answer = 1;
} else {
	$answer = 0;
}

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"><!-- For the details later-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script><!-- JQUERY for the continuous checking of data-->

<!-- Form To Submit To Next Page AKA GameOver.php -->
<style>
    #submit
    {    
        visibility: hidden;
    }
	</style>
<form name="myForm" id="myForm" target="_myFrame" action="GameOver.php" method="POST">
        <p><input name="test" type="hidden" value="<?php echo $answer ?>" /></p>
		<p><input name="id" type="hidden" value="<?php echo $id ?>" /></p>
        <p><input type="submit" id="submit" value="submit" /></p>
</form>

<script>
//Function to Auto Submit Form
function submitform(){
          document.forms["myForm"].submit();
        }

var MyVar = ''; //whatever the default state is    
window.setInterval(function(){
      $.ajax({
        url:"ReceiveCommands.php",
        dataType: 'text',
        data: {state:MyVar}, 
        success:function(data){
          console.log('data loaded: ' + data); //just to check the console
          if(data === "1"){
            //Do what I want
			var php_id = "<?php echo $id; ?>"
			var php_answer = "<?php echo $answer; ?>"
			window.location = `GameOver.php?id=${php_id}&answer=${php_answer}`;
          }else if(data === "2"){
            //Do what I want too
			var php_id = "<?php echo $id; ?>"
			var php_answer = "<?php echo $answer; ?>"
			window.location = `GameOver.php?id=${php_id}&answer=${php_answer}`;
		  }
		}
      });
    }, 2000);
</script>

<!-- To center the loading GIF -->
<style>
.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 20%;
}
</style>

   <div class="col-md-6 offset-md-3 mt-5">
   <img src="https://c.tenor.com/5o2p0tH5LFQAAAAi/hug.gif" class="center">
    </div> 

    </body>
</html>
