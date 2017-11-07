<?php
/*
Class MySQLiService inherits interface IServiceDB and must have his 4 implemented functions
*/
class MySQLiService implements IServiceDB
{
	private $connectDB;

/*
function connect create connection to MySQL DB and save it to variable connectDB.
Return true if connection is OK or print error message if has error.
DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE are global variables, have settings for connection to DB
*/
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
		if ($this->connect()) { // if Connection failed no action have be done
			if ($result = mysqli_query($this->connectDB, 'SELECT * FROM film')) { // variable result saves data from BD, if has error no action have be done
				while ($row = mysqli_fetch_assoc($result)) { // fetch a result row as associative array $row (key,value)
					$films[]=new Film($row['film_id'], $row['title'], $row['description'],
										$row['release_year'],  $row=['length']); // turn to the array by columns name(key)
                 }
				 mysqli_free_result($result); // releases the memory
			}
		    mysqli_close($this->connectDB); // close connection
		}
		return $films;
	}

	public function getFilmByID($id)
	{
		$film=null;
		if ($this->connect()) {
			if ($query = mysqli_prepare($this->connectDB, 'SELECT * FROM film WHERE film_id=?')) { // prepare an SQL statement for execution, if has error no action have be done. '?' - param
				$query->bind_param("i", $id); //"i" - $id is integer. Bind parameters for markers
				$query->execute(); // run execution
				$result = $query->get_result(); // get result from query
				$numRows = $result->num_rows; // number of rows in result
				if ($numRows==1) {
					$row=$result->fetch_array(MYSQLI_NUM); // fetch a result row as a numeric array
					$film=new Film($row[0], $row[1], $row[2], $row[3], $row[5]); // turn to the array by index
				}
				$query->close();
			}
		    mysqli_close($this->connectDB);  // close connection
		}
	    return $film;
	}

	public function getAllFilmsInfo()
	{
		$films=array();
		if ($this->connect()) {
			if ($result = mysqli_query($this->connectDB, 'SELECT * FROM film_info')) {
				while ($row = mysqli_fetch_assoc($result)) { // fetch a result row as associative array $row (key,value)
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
					$films[]=new FilmInfo($row['id'], $row['title'], $row['description'], // turn to the array 'row' by column name(key)
										$row['year'],  $row=['length'], $actors, $categories, $language);

                 }
				 mysqli_free_result($result); // releases the memory
			}
		    mysqli_close($this->connectDB); // close connection
		}
		return $films;
	}

}
