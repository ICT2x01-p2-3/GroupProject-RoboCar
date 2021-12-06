<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MazeDriver</title>

    <!-- Bootstrap core CSS -->
<link href="../static/content/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>


    <!-- Custom styles for this template -->
    <link href="../static/content/cover.css" rel="stylesheet">
  </head>

  <body class=" h-100 text-center text-white bg-dark">
<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="{{ url_for('dashboard_render') }}">MazeDriver</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="{{ url_for('pinPage') }}">Pin</a>
      <a class="nav-item nav-link" href="{{ url_for('ChallengeBoundary') }}">Challenges</a>
      <a class="nav-item nav-link" href="#">Log Out</a>

    </div>
  </div>
</nav>
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">

  <header class="mb-auto">
    <div>
      <h1 >The Maze Driver</h1>
      </nav>
    </div>
  </header>

  <main class="px-3">
    <h1>Current Pin: {% if data %} {{data}} {% else %} None {% endif%}</h1>
    <div class="input-group input-group-lg">

    </div>
      </br>
    <p class="lead">
      <form method = "POST" action='{{ url_for("GeneratePin") }}'>
      <input type="hidden" name="csrf_token" value="{{ csrf_token() }}"/>
      <button class="btn btn-lg btn-secondary fw-bold border-white bg-white">Generate Pin</button>
      </form>
    </p>
  </main>

  <footer class="mt-auto text-white-50">
  </footer>
</div>



  </body>
</html>
