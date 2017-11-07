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

    </head>
    <body>

      <nav class="navbar fixed-top navbar-expand-sm navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-content" aria-controls="nav-content" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="nav-content">
    <ul class="navbar-nav mr-auto mt-2 mt-md-0">
    <li class="nav-item">
    <a class="nav-link" href="Categories.php">Category</a>
    </li>
    <li class="nav-item mr-auto mt-2 mt-md-0">
    <a class="nav-link" href="Actors.php">Actors</a>
    </li>
    </ul>

    <form class="form-inline my-2 my-lg-0">
    <input class="form-control mr-sm-2" type="text" placeholder="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </nav>

    <div class="container" style="margin-top: 100px; margin-bottom: 50px">
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
                        <h2>Films List for actor <?php echo $actor->lastname.' '.$actor->lastname ?></h2>
                        <?php
                    }
                    ?>
                        
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

    <footer class="py-2 bg-dark">
        <div class="h6 text-center" style="color: #dcdcdc;">Ivan Panas RDIR51</div>
    </footer>
    </body>
</html>
