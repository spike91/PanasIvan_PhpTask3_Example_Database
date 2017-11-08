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
      <link href=" https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css " rel="stylesheet "/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js "></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js "></script>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js "></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="Bootstrap/js/bootstrap.min.js "></script>
        <script src="Bootstrap/js/bootstrap.js "></script>
    </head>
    <body>

    <nav class="navbar fixed-top navbar-expand-sm navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-content" aria-controls="nav-content" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="nav-content">
    <ul class="navbar-nav mr-auto mt-2 mt-md-0">
    <li class="nav-item">
    <a class="nav-link" href="index.php">Home</a>
    </li>
    <li class="nav-item mr-auto mt-2 mt-md-0">
    <a class="nav-link" href="actors.php">Actors</a>
    </li>
    <li class="nav-item dropdown mr-auto mt-2 mt-md-0">
    <a class="nav-link dropdown-toggle" href="films.php" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categories</a>
          <div class="dropdown-menu" aria-labelledby="dropdown01">
          <?php 
          $db=new PDOService();
          $categories=$db->getAllCategories();
          foreach($categories as $category){ ?>
            <a class="dropdown-item" href="films.php?categoryId=<?php echo $category->id?>"><?php echo $category->name?></a>
          <?php }
          ?>
          </div>
  </div>
    </li>
    </ul>

    <form class="form-inline my-2 my-lg-0" method="get" action="index.php">
    <input class="form-control mr-sm-2" type="text" placeholder="Search" name="search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    </nav>

<div class="container" style="margin-bottom: 50px">
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
