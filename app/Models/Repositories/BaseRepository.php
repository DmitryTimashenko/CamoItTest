<?php

namespace Models\Repositories;
use Core\Database;


abstract class BaseRepository
{

    protected $db;

    function __construct()
    {
        $this->db = Database::connect()->database;
        $errors = Database::connect()->errors;
    }

}