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

.obstacle{
  background-color:green;
  height:10em;
}
.car{
  background-color:red;
  height:10em;
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


function submit() {
        {% if solution %}
        var solution = {{solution}};
        {% else %}
        var solution = document.getElementById("Solution").value;
        {% endif %}
        {% if update_map %}
        var info = {"solution":solution, "map":{{update_map}}};
        {% else %}
        var info = {"solution":solution, "map":{{data.grid}}};
        {% endif %}
        $.ajax({
            type: 'POST',
            url : '{{url_for("studentSubmit")}}',
            data: JSON.stringify(info),
            contentType: 'application/JSON',
            dataType: 'json',
            // ON SUCCESS
            success: function (data) {
            if (data == 'success')
                console.log(data);
            }
        });
}
{% if valid %}
 window.onload = submit;
{% endif %}
</script>
<!-- End Of Navigation Bar -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">

   <div class="col-md-6 offset-md-3 mt-5">
        <br>
        <h1></h1>
         {% if map %}
         <table class="table" align="center">
           {% for row in map %}
           <tr>
           {% for col in row %}
           {% if col == "1" %}
            <td class="obstacle"></td>
           {% elif col == "2" %}
            <td class="car"></td>
           {% elif col == "0" %}
             <td class="path"></td>
           {% endif %}
           {% endfor %}
           </tr>
           {% endfor %}
         </table>
         {% endif %}
        <form enctype="multipart/form-data" method="post">
          <div class="form-group">
          {% if data %}
            <input type="hidden" name="csrf_token" value="{{ csrf_token() }}"/>
            <label>Chalenge Name: {{data.name}}</label>
          </div>
          <div class="form-group">
            <label>Challenge difficulty: {{data.difficulty}}</label>
          </div>
          <div class="form-group">
            <label required="required">Commands To Execute</label>
            <input type="text" name="Solution" class="form-control" id="Solution" placeholder="Enter commands for the car to execute here" readonly/>
          </div>
		  <input type="button" class="btn btn-light" value="Move Forward" name="PressForwardButton" onclick="PressForward()"></button>
		  <input type="button" class="btn btn-light" value="Turn Right" name="PressRightButton" onclick="PressRight()"></button>
		  <input type="button" class="btn btn-light" value="Turn Left" name="PressLeftButton" onclick="PressLeft()"></button>
		  <input type="button" class="btn btn-light" value="Clear" name="PressClearButton" onclick="PressClear()"></button>
		  {% endif %}

		  <p><input name="id" type="hidden" value="<?php echo $id ?>" /></p>
          <hr>
          <hr>
        </form>
        <button onclick="submit()" type="submit" class="btn btn-primary">Submit</button>

    </div> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </body>
</html>
