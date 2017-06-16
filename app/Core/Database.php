<?php
namespace Core;

class Database
{
    public $database;
    public $errors;

    private static $dbInstance = null;

    private function __construct()
    {
        $host = Configure::getParam('db_host');
        $dbname = Configure::getParam('db_name');
        $username = Configure::getParam('db_user');
        $password = Configure::getParam('db_password');

        $dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;

        [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION];

        try {
            $this->database = new \PDO($dsn, $username, $password);
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