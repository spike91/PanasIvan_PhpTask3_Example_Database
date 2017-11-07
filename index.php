<?php
require_once "autoloader.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
			///$db=new MySQLiService();
			$db=new PDOService();
			foreach ($db->getAllFilms() as $film) {
				echo $film->id." ".$film->title."<br />";
			}
			$film=$db->getFilmByID(3);
			if (!is_null($film)) {
				echo "Film found: ".$film->title."<br />";
			}
			else {
				echo "Not found"."<br />";
			}
			echo "<pre>";
			$films=$db->getAllFilmsInfo();
			foreach ($films as $film) {
				var_dump($film);
			}
			echo "</pre>";
        ?>
    </body>
</html>
