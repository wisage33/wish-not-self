<?php

class User {
    private $config;
    private $pdo;
    public function __construct()
    {
        $config = require_once(__DIR__ . '/../../config/config.php');
        $this->config = $config['db'];
        try {
            $this->pdo = new PDO("mysql:host={$this->config['host']};dbname={$this->config['dbname']}", 
        $this->config['user'], 
        $this->config['pass'], 
        $this->config['options']);
        } catch (PDOException $e) {
            echo "Error: ". $e->getMessage();
        }
    }

    public function register($login, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (username, email, password_hash) VALUES (:login, :email, :password)";
        try {
            $stmt = $this->pdo->prepare($query);
            $result = $stmt->execute([
            ':login' => $login,
            ':email' => $email,
            ':password' => $hashedPassword
        ]);
        return $result;
        } catch (PDOException $e) {
            echo "Error: ". $e->getMessage();
            return false;
        }
    }

    public function login($login, $password) {
        $query = "SELECT * FROM users WHERE username = ':login'";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':login' => $login]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return true;
        } else {
            return false;
        }
    }
}