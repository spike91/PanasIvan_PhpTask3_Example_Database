<?php
require_once "autoloader.php";
?>
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
                    <?php
                    $db=new PDOService();
                    if(isset($_REQUEST['categoryId'])){ 
                        $category_id=$_REQUEST['categoryId'];                       
                        $category=$db->getCategoryByID($category_id);
                        $films=$db->getFilmsByCategoryID($category_id);
                        ?>    
                        <h2>Films List for category <?php echo $category->name ?></h2>
                        <?php
                    } else if(isset($_REQUEST["actorId"])){
                        $actor_id=$_REQUEST['actorId'];
                        $actor=$db->getActorByID($actor_id);
                        $films=$db->getFilmsByActorID($actor_id);
                        ?>    
                        <h2>Films List for actor <?php echo $actor->firstname.' '.$actor->lastname ?></h2>
                        <?php
                    }
                    ?>
                        
                        <table class="table table-striped table-hover">
                        <thead class="thead-inverse">
                        <tr>
                            <th><div class="text-center">Title</div></th>
                            <th><div class="text-center">Year</div></th>
                            <th><div class="text-center">Description</div></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        
                        foreach($films as $film){?>
                            <tr>
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

    <footer class="py-2 bg-dark">
        <div class="h6 text-center" style="color: #dcdcdc;">Ivan Panas RDIR51</div>
    </footer>
    </body>
</html>
