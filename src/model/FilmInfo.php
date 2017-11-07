<?php
/*
Class FilmInfo has parent class Film and run parent constructor at own constructor
*/
class FilmInfo extends Film
{
    public $actors=array();
    public $categories=array();
    public $language;

    public function __construct($id, $title, $description, $releaseYear, $length, $actors, $categories, $language)
    {
        parent::__construct($id, $title, $description, $releaseYear, $length);
        $this->actors=$actors;
        $this->categories=$categories;
        $this->language=$language;
    }
}
