<?php
require_once "autoloader.php";
?>
<!DOCTYPE html>
<html>
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title></title>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
      <link href="bootstrap/css/navbar.css" rel="stylesheet">

    </head>
    <body>

      <nav class="navbar fixed-top navbar-expand-sm navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-content" aria-controls="nav-content" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>


    <!-- Links -->
   <div class="collapse navbar-collapse" id="nav-content">
    <ul class="navbar-nav">
    <li class="nav-item">
    <a class="nav-link" href="">Category</a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="Actors.php">Actors</a>
    </li>
    </ul>

  </nav>

    <div class="container" style="margin-top: 100px; margin-bottom: 30px">
                <div class="row" >
                  <h2>Films List</h2>
                    <table class="table table-striped table-hover">
                        <thead class="thead-inverse">
                        <tr>
                            <th><div class="text-center">Id</div></th>
                            <th><div class="text-center">Title</div></th>
                            <th><div class="text-center">Year</div></th>
                            <th><div class="text-center">Description</div></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $db=new PDOService();
                        $films=$db->getFilmByCategoryID($_REQUEST['categoryId']);

                        foreach($films as $film){?>
                            <tr>
                                <td><div class="text-center"><?php echo $film->id ?></div></td>
                                <td><div class="text-center"><?php echo $film->title ?></div></td>
                                <td><div class="text-center"><?php echo $film->releaseYear ?></div></td>
                                <td><div class="text-center"><?php echo $film->description ?></div></td>
                            </tr>
                            <?php
                         }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>

    <footer class="py-4 bg-dark" style="bottom: 0;position: fixed;width: 100%">
        <div class="h6 text-center" style="color: #dcdcdc;">Ivan Panas RDIR51</div>
    </footer>
<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>
