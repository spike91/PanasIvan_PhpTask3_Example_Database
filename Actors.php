<?php
require_once "autoloader.php";
?>
<!--
Autor: Ivan Panas RDIR51
    UlesannePHPAndmebaasid
    Ülesanne. Maailma filmid (30 p.)
1. Kommenteerige programmi kood Example. MoviesDB (15 p.)

2. Koostage menüü - (Category) (5 p.) - lisage getAllCategories funktsioon klassi. 

3. Kuvage filmide loetelu valitud kategooria järgi (5 p.)

4. Looge leht Näitlejad (andmed sorteeritud perekonnanime järgi kasvavas järjekorras ). Kuvage filmide loetelu  valitud näitleja järgi (5 p.)

Kasutage Front-End CSS Framework (näiteks, Bootstrap,...)
-->
<!DOCTYPE html>
<html>
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title></title>
      <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
      <link href="bootstrap/css/custom.css" rel="stylesheet">

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
    <a class="nav-link" href="Categories.php">Category</a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="">Actors</a>
    </li>
    <li class="nav-item">
      <div class="dropdown">
  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Action
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="#">Action</a>
    <a class="dropdown-item" href="#">Another action</a>
    <a class="dropdown-item" href="#">Something else here</a>
</div>
            </li>
    </ul>

    </nav>

<div class="container" style="margin-top: 100px; margin-bottom: 50px">
                <div class="row" >
                  <h2>Actors List</h2>
                    <table class="table table-striped table-hover">
                        <thead class="thead-inverse">
                        <tr>
                            <th><div class="text-center">Last Name</div></th>
                            <th><div class="text-center">First Name</div></th>
                            <th><div class="text-center">Action</div></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $db=new PDOService();
                        $actors=$db->getAllActors();

                        foreach($actors as $actor){?>
                            <tr>
                                <td><div class="text-center"><?php echo $actor->lastname ?></div></td>
                                <td><div class="text-center"><?php echo $actor->firstname ?></div></td>
                                <td>
                                    <form method="get">
                                        <div class="text-center">
                                            <a href="Films.php?actorId=<?php echo $actor->id ?>" name="actorId">
                                                <button type="button" class="btn btn-dark" type="submit">Films</button>
                                            </a>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            <?php
                         }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>

    <footer class="py-2 bg-dark">
        <div class="h6 text-center" style="color: #dcdcdc;">Ivan Panas RDIR51</div>
    </footer>
    </body>
</html>
