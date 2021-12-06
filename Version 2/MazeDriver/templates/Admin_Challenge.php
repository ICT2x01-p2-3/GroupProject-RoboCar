<!DOCTYPE html>
<html>
<head>
<link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/cover/">
    <!-- Bootstrap core CSS -->
<link href="../static/content/bootstrap.min.css" rel="stylesheet">
</head>
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

.table{
   width:95%;
   table-layout: auto;
   overflow-wrap: break-word;
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

<div style="padding-left:16px">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <br>
<h1>Challenges</h1>
<p>To add a challenge, please click <a href="{{ url_for('addChallenge') }}">here</a></p>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
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
                   {% for row in data %}
                    <tr>
                    <td>{{row.id}}</td>
                    <td>{{row.name}}</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>
                    </td>
                    <td>{{row.solution}}</td>
					<td>{{row.difficulty}}</td>
                    <td>
                            <form method = "POST" action='{{ url_for("deleteChallenge") }}'>
                            <input type="hidden" name="csrf_token" value="{{ csrf_token() }}"/>
                            <input type="hidden" name="id" value="{{ row.id }}"/>
                            <button class="btn btn-danger" name = "delete" onclick = "Alert()"> Delete </button>
                            </form>
                    </td>
                        </tr>
                    {% endfor %}

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

                </tbody>
            </table>
        </div>

<!-- Modal -->

<script>
    function Alert() {confirm("Are you sure?");}
</script>
    </body>
</html>
