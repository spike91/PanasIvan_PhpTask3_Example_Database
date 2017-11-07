<?php

class PDOService implements IServiceDB
{
	private $connectDB;

	// creating a connection between PHP and a database server, return true or exit with error
	public function connect() {
        try {
            $this->connectDB = new PDO("mysql:host=".DB_HOST.";dbname=".DB_DATABASE.";charset=".DB_CHARSET,
                                DB_USERNAME, DB_PASSWORD);
        }
		catch (PDOException $ex) {
			printf("Connection failed: %s", $ex->getMessage());
			exit();
		}
		return true;
	}

	public function getAllFilms()
	{
		$films=array();
		if ($this->connect()) {
			if ($result = $this->connectDB->query('SELECT * FROM film')) { // executes an SQL statement(all films from table film) save as a PDOStatement object to variable 'result'
				$rows = $result->fetchAll(PDO::FETCH_ASSOC); // fetch all the remaining results as associative array
                foreach($rows as $row){
					$films[]=new Film($row['film_id'], $row['title'], $row['description'],
										$row['release_year'], $row['language_id'], $row=['length']); // turn to the array by columns name(key)
                 }
			}
		}
        $this->connectDB=null; // close connection
		return $films;
	}


	public function getFilmByID($id)
	{
		$film=null;
		if ($this->connect()) {
			if ($result = $this->connectDB->prepare('SELECT * FROM film WHERE film_id=:id')) { // prepares a statement(film by film_id) for execution and returns a statement object
				$result->execute(array('id'=>$id)); // executes a prepared statement included parameter markers 'id'
				//$result->execute(['id'=>$id]);
                // $result->bindValue(':id', $id, PDO::PARAM_INT); // binds a value to a parameter ':id' with explicit data_type(PARAM_INT)
                // $result->execute();

				$numRows = $result->rowCount(); // returns the number of rows
				if ($numRows==1) {
					$row=$result->fetch(); // fetches the next row with default fetch_style
					$film=new Film($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]); // turn to the array by index
				}
			}
		}
        $this->connectDB=null;
	    return $film;
	}

    public function getAllFilmsInfo()
	{
		$films=array();
		if ($this->connect()) {
			if ($result = $this->connectDB->query('SELECT * FROM film_info')) {
				$rows = $result->fetchAll(PDO::FETCH_ASSOC); // fetch a result as associative array(key,value) indexed by column name
                foreach($rows as $row){
					$actors=array();
					foreach (explode(";",$row['actors']) as $item) { // Split row['actors'] by ';' and save to variable 'item'
					   $actor=explode(",",$item); // Split each actors by ',' and save to variable 'actor'
					   $actors[]=new Actor($actor[0], $actor[1],$actor[2]); // turn to the array 'actor' by index
					}
					$categories=array();
					foreach (explode(";",$row['categories']) as $item) {
					   $category=explode(",",$item);
					   $categories[]=new Category($category[0], $category[1]);
					}
					$item=explode(',',$row['language']);
					$language=new Language($item[0], $item[1]);
					$films[]=new FilmInfo($row['id'], $row['title'], $row['description'],
										$row['year'],  $row=['length'], $actors, $categories, $language); // turn to the array 'row' by column name(key)
                 }
			}
		    $this->connectDB=null;
		}
		return $films;
	}

	public function getAllCategories(){
		$categories=array();
		if ($this->connect()) {
			if ($result = $this->connectDB->query('SELECT * FROM category')) {
				$rows = $result->fetchAll(PDO::FETCH_ASSOC);
                foreach($rows as $row){
					$categories[]=new Category($row['category_id'], $row['name']);
                 }
			}
		}
        $this->connectDB=null;
		return $categories;
	}

	public function getAllActors(){
		$actors=array();
		if ($this->connect()) {
			if ($result = $this->connectDB->query('SELECT * FROM actor ORDER BY lastname ASC')) {
				$rows = $result->fetchAll(PDO::FETCH_ASSOC);
                foreach($rows as $row){
					$actors[]=new Actor($row['actor_id'], $row['firstname'], $row['lastname']);
                 }
			}
		}
        $this->connectDB=null;
		return $actors;
	}

	public function getFilmsByCategoryID($id)
	{
		$films=array();
		if ($this->connect()) {
			if ($result = $this->connectDB->prepare('SELECT * FROM film as f JOIN film_category as fc ON f.film_id=fc.film_id WHERE fc.category_id=:id')) {
				$result->execute(array('id'=>$id));
					$rows=$result->fetchAll(PDO::FETCH_BOTH);
					foreach($rows as $row){
		$films[]=new Film($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
					 }
				}

		}
        $this->connectDB=null;
	    return $films;
	}

	public function getFilmsByActorID($id)
	{
		$films=array();
		if ($this->connect()) {
			if ($result = $this->connectDB->prepare('SELECT * FROM film as f JOIN film_actor as fa ON f.film_id=fa.film_id WHERE fa.actor_id=:id')) {
				$result->execute(array('id'=>$id));
					$rows=$result->fetchAll(PDO::FETCH_BOTH);
					foreach($rows as $row){
		$films[]=new Film($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
					 }
				}

		}
        $this->connectDB=null;
	    return $films;
	}

	public function getCategoryByID($id)
	{
		$category=null;
		if ($this->connect()) {
			if ($result = $this->connectDB->prepare('SELECT * FROM category WHERE category_id=:id')) { 
				$result->execute(array('id'=>$id)); 	

				$numRows = $result->rowCount(); 
				if ($numRows==1) {
					$row=$result->fetch();
					$category=new Category($row[0], $row[1]);
				}
			}
		}
        $this->connectDB=null;
	    return $category;
	}

	public function getActorByID($id)
	{
		$actor=null;
		if ($this->connect()) {
			if ($result = $this->connectDB->prepare('SELECT * FROM actor WHERE actor_id=:id')) { 
				$result->execute(array('id'=>$id)); 	

				$numRows = $result->rowCount(); 
				if ($numRows==1) {
					$row=$result->fetch();
					$actor=new Actor($row[0], $row[1], $row[2]);
				}
			}
		}
        $this->connectDB=null;
	    return $actor;
	}

	public function getActorsBySearchAny($str){
		$actors=array();
		if ($this->connect()) {
			if ($result = $this->connectDB->prepare('SELECT * FROM actor WHERE firstname=:str OR lastname=:str')) { 
				$result->bindValue(':str', $str, PDO::PARAM_STR);
				$result->execute();
					$rows=$result->fetchAll();
					foreach($rows as $row){
					$actor=new Actor($row[0], $row[1], $row[2]);
					}
				
			}
		}
        $this->connectDB=null;
		return $actors;
	}

}
