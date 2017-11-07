<?php

class MySQLiService implements IServiceDB
{	
	private $connectDB;
	
	public function connect() {	
		$this->connectDB = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
		$this->connectDB->set_charset(DB_CHARSET);
		if (mysqli_connect_errno()) {
			printf("Connection failed: %s", mysqli_connect_error());
			exit();
		}
		return true;
	}
	
	public function getAllFilms()
	{	
		$films=array();
		if ($this->connect()) {
			if ($result = mysqli_query($this->connectDB, 'SELECT * FROM film')) {
				while ($row = mysqli_fetch_assoc($result)) {
					$films[]=new Film($row['film_id'], $row['title'], $row['description'], 
										$row['release_year'],  $row=['length']);
                 } 
				 mysqli_free_result($result);
			}
		    mysqli_close($this->connectDB);	
		}
		return $films;
	}
	
	public function getFilmByID($id)
	{	
		$film=null;
		if ($this->connect()) {
			if ($query = mysqli_prepare($this->connectDB, 'SELECT * FROM film WHERE film_id=?')) {
				$query->bind_param("i", $id); //"i" - $id is integer
				$query->execute();
				$result = $query->get_result();
				$numRows = $result->num_rows;
				if ($numRows==1) {
					$row=$result->fetch_array(MYSQLI_NUM);
					$film=new Film($row[0], $row[1], $row[2], $row[3], $row[5]);
				}
				$query->close();
			}
		    mysqli_close($this->connectDB);	
		}
	    return $film;	
	}

	public function getAllFilmsInfo()
	{
		$films=array();
		if ($this->connect()) {
			if ($result = mysqli_query($this->connectDB, 'SELECT * FROM film_info')) {
				while ($row = mysqli_fetch_assoc($result)) {
					$actors=array();
					foreach (explode(";",$row['actors']) as $item) {
					   $actor=explode(",",$item);
					   $actors[]=new Actor($actor[0], $actor[1],$actor[2]);
					}
					$categories=array();
					foreach (explode(";",$row['categories']) as $item) {
					   $category=explode(",",$item);
					   $categories[]=new Category($category[0], $category[1]);
					}
					$item=explode(',',$row['language']);
					$language=new Language($item[0], $item[1]);
					$films[]=new FilmInfo($row['id'], $row['title'], $row['description'], 
										$row['year'],  $row=['length'], $actors, $categories, $language);
					
                 } 
				 mysqli_free_result($result);
			}
		    mysqli_close($this->connectDB);	
		}
		return $films;
	}

}

