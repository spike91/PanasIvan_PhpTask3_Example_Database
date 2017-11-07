<?php

interface IServiceDB
{
    public function connect();
    public function getAllFilms();
    public function getFilmByID($id);
    public function getAllFilmsInfo();
}