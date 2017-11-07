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

    <div class="container" style="margin-top: 100px; margin-bottom: 50px">
                <div class="row" >
                  <h2>Categories List</h2>
                    <table class="table table-striped table-hover">
                        <thead class="thead-inverse">
                        <tr>
                            <th><div class="text-center">Id</div></th>
                            <th><div class="text-center">Name</div></th>
                            <th><div class="text-center">Actions</div></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $db=new PDOService();
                        $categories=$db->getAllCategories();

                        foreach($categories as $category){?>
                            <tr>
                                <td><div class="text-center"><?php echo $category->id ?></div></td>
                                <td><div class="text-center"><?php echo $category->name ?></div></td>
                                <td>
                                    <form method="get">
                                        <div class="text-center">
                                            <a href="Films.php?categoryId=<?php echo $category->id ?>" name="categoryId">
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
