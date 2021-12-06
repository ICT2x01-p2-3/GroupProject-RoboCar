<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="../static/content/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<meta name="viewport" content="width=device-width, initial-scale=1">

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
  <a href="{{ url_for('studentSelect') }}">Home</a>
  <a href="{{ url_for('studentScore') }}">Scoreboard</a>
  <a href="{{ url_for('studentChallenge') }}" class="active">Challenge</a>
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

<!-- Apply Bootstrap CSS After Above Content Loaded For Table -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
<style>.table{
   width:95%;
   table-layout: auto;
   overflow-wrap: break-word;
   border-collapse: collapse;
     border-spacing: 0;
}</style>
<div class='container'>
<div class ='row'>
<h2> Select your Difficulty:</h2>
<form action="{{ url_for('student') }}" method="POST">
<select name="difficulty" class='form-select'>
  <option selected value="easy">Easy</option>
  <option value="medium">Normal</option>
  <option value="hard">Hard</option>
</select>
</form>
</div>
            <table class = "table" align="center">
                <thead>
                    <tr>
                        <th>Challenge ID</th>
                        <th>Challenge Name</th>
                        <th>Difficulty Level</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="table">
                    {% if data %}
                    {% for row in data %}
                    <tr>
                    <td>{{row.id}}</td>
                    <td>{{row.name}}</td>
					<td>{{row.difficulty}}</td>
                    <td>
                        <form action = "{{ url_for('studentChallenge') }}" method = "POST">
                        <input type="hidden" name="csrf_token" value="{{ csrf_token() }}"/>
                        <button class="btn btn-success" name = "id" value = "{{row.id}}"> Attempt </button>
                        </form>
                    </td>
                        </tr>
                    {% endfor %}
                </tbody>
            </table>
                {% else %}
                <h1>No Data found!</h1>
                {% endif %}
        </div>
    </div>
    </body>
    <link href="../static/content/bootstrap.min.css" rel="stylesheet">
</html>
