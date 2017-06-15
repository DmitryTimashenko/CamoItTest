<?php
namespace Core;

class Database
{
    private $host = '127.0.0.1';
    private $username = 'root';
    private $password = 'rhfcrb#1';
    private $dbname = 'zf2test';

    public $database;
    public $errors;

    private static $dbInstance = null;

    private function __construct()
    {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;

        [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION];

        try {
            $this->database = new \PDO($dsn, $this->username, $this->password);
        } catch (\PDOException $ex) {
            $this->errors = $ex;
        }
    }

    public static function connect()
    {
        if (!isset(self::$dbInstance)) {
            self::$dbInstance = new self();
        }

        return self::$dbInstance;
    }

}