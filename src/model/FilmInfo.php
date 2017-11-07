<?php

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

