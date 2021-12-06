<!DOCTYPE html>
<html>
<head>
<link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/cover/">
    <!-- Bootstrap core CSS -->
<link href="../static/content/bootstrap.min.css" rel="stylesheet">
</head>
<body>
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
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="{{ url_for('dashboard_render') }}">MazeDriver</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link" href="{{ url_for('pinPage') }}">Pin</a>
      <a class="nav-item nav-link active" href="{{ url_for('ChallengeBoundary') }}">Challenges</a>
      <a class="nav-item nav-link" href="#">Log Out</a>

    </div>
  </div>
</nav>
<!-- End Of Navigation Bar -->

   <div class="col-md-6 offset-md-3 mt-5">
        {% if error %}
        <div class="alert alert-danger" role="alert">
            {% if error == 1 %}
                  Missing Parameters
            {% elif error == 2 %}
                  No File parts
            {% elif error == 3 %}
                  No Selected Files
            {% elif error == 4 %}
                  Invalid extensions, Please provide .txt files
            {% endif %}
          </div>
        {% endif %}
        <br>
        <form enctype="multipart/form-data" action="{{ url_for('addChallenge') }}" method="post">
        <input type="hidden" name="csrf_token" value="{{ csrf_token() }}"/>
          <div class="form-group">
            <label>Challenge Name</label>
            <input type="text" name="ChallengeName" class="form-control" id="ChallengeName" placeholder="Enter Challenge's Name" required="required">
          </div>
          <div class="form-group">
            <label required="required">Solution</label>
            <input type="text" name="Solution" class="form-control" id="Solution" placeholder="Enter solution for challenge" readonly/>
          </div>
		  <input type="button" class="btn btn-light" value="Forward" name="PressForwardButton" onclick="PressForward()"></button>
		  <input type="button" class="btn btn-light" value="Right" name="PressRightButton" onclick="PressRight()"></button>
		  <input type="button" class="btn btn-light" value="Left" name="PressLeftButton" onclick="PressLeft()"></button>
		  <input type="button" class="btn btn-light" value="Clear" name="PressClearButton" onclick="PressClear()"></button>

          <div class="form-group">
            <label for="exampleFormControlSelect1">Difficulty Level</label>
            <select class="form-control" id="Difficulty" name="Difficulty" required="required">
              <option>Easy</option>
              <option>Medium</option>
              <option>Hard</option>
            </select>
          </div>
          <hr>
  <!--<div class="custom-file">
    <input type="file" class="custom-file-input" id="fileToUpload" name="fileToUpload" required>
    <label class="custom-file-label" for="validatedCustomFile">Upload Image Here...</label>
  </div>-->
  <input type="file" name="fileToUpload" id="fileToUpload">
          <hr>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div> 
    

<script>
function PressRight() {
document.getElementById("Solution").value+= 'Right ';
}
function PressLeft() {
document.getElementById("Solution").value+= 'Left ';
}
function PressForward() {
document.getElementById("Solution").value+= 'Forward ';
}
function PressClear() {
document.getElementById("Solution").value= '';
}
function navBarFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}

</script>
</body>
</html>