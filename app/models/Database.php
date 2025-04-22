<?php

use PDO;

class Database {
    protected $pdo;
    private $config;

    public function __construct()
    {
        $config = require(__DIR__ . '/../../config/config.php');
        $this->config = $config['db'];
        $this->connect();
    }

    public function connect()
{

    if (!$this->pdo) {
        try {
            $host = $this->config['host'];
            $dbname = $this->config['dbname'];
            $user = $this->config['user'];
            $pass = $this->config['pass'];
            $options = $this->config['options'];
            
            $dsn = "mysql:host={$host};dbname={$dbname}";
            // echo "Host: " . var_export($host, true) . "<br>";
            // echo "DB Name: " . var_export($dbname, true) . "<br>";
            // echo "User: " . var_export($user, true) . "<br>";
            // echo "Password: " . var_export($pass, true) . "<br>";

            $this->pdo = new PDO($dsn, $user, $pass, $options);

            return $this->pdo;
        } catch (PDOException $e) {
            echo "Database connection failed: " . $e->getMessage() . "<br>";
            return null;
        }
    }

    return $this->pdo;
}
}