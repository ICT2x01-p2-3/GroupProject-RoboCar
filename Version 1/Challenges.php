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

<!DOCTYPE html>
<html>
<body>


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

<div style="padding-left:16px">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <br>
<h1>Challenges</h1>
<p>To add a challenge, please click <a href="AddChallenge.php">here</a></p>
</div>

<!-- Apply Bootstrap CSS After Above Content Loaded For Table -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
<style>.table{
   width:95%;
   table-layout: auto;
   overflow-wrap: break-word;
}</style>
<div>
            <table class = "table" align="center">
                <thead>
                    <tr>
                        <th>Challenge ID</th>
                        <th>Challenge Name</th>
                        <th>Image</th>
                        <th>Solution</th>
                        <th>Difficulty Level</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody id="table">
                    <?php
                    $sql = 'SELECT * FROM challenges';
                    if ($result = $conn->query($sql)) {
                        while ($row = $result->fetch_assoc()) {
                            $id = $row["id"];
                            $name = $row["name"];
                            $image = $row["image"];
                            $commands = $row["commands"];
							$difficulty = $row["difficulty"];

                            echo '<tr>
                    <td>' . $id . '</td>
                    <td>' . $name . '</td>
                    <td><img src="' . $image . '" max-width="500" max-height="500"></td>
                    <td>' . $commands . '</td> 
					<td>' . $difficulty . '</td> 
                    <td>
                            <form method = "POST">
                            <button class="btn btn-danger" name = "delete" onclick = "deleteAjax(' . $id . ')"> Delete </button>
                            </form>
                    </td>
                        </tr>';
                        }
                    } else {
                        echo '<script>alert("0 Results Retrieved!")</script>';
                    }
                    ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script type="text/javascript">
                    //function to delete row
                    function deleteAjax(id) {
						var r = confirm("Are you sure that you want to delete this challenge?");
  if (r == true) {
                        $.ajax({
                            type: 'post',

                            //call delete php file 
                            url: 'delete_challenge.php',

                            //post to delete php called $delete_id
                            data: {delete: id},
                            success: function (data) {
                                //hide the row after delete
                                $('#delete' + id).hide('slow');
                            }
                        });
  } else {
  }
                    }
                </script>

                </tbody>
            </table>
        </div>

    </body>
</html>
