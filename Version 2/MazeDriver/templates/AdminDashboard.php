<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/cover/">
    <!-- Bootstrap core CSS -->
<link href="../static/content/bootstrap.min.css" rel="stylesheet">
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
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand active" href="{{ url_for('dashboard_render') }}">MazeDriver</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link" href="{{ url_for('pinPage') }}">Pin</a>
      <a class="nav-item nav-link" href="{{ url_for('ChallengeBoundary') }}">Challenges</a>
      <a class="nav-item nav-link" href="#">Log Out</a>

    </div>
  </div>
</nav>

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
  <h2>Admin Dashboard</h2>
  <p>Welcome to P2-3's 2X01 Web Server</p>
</div>


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<div class="col-sm-12">
<div class="row">
        <div class="col-sm-3">
          <div class="well">
            <h4>Connectivity</h4>
            <p><?php echo $connectivity; ?></p> 
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h4>Object Distance Detection</h4>
            <p><?php echo $speed; ?> cm</p> 
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h4>Speed</h4>
            <p><?php echo $speed; ?> KM/H</p> 
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