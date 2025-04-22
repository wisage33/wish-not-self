<?php

class UserModel {
    private $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->connect();
    }

    public function register($username, $email, $password) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users WHERE (username, email, password_hash) VALUES (:username, :email, :password_hash";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password_hash' => $passwordHash
        ]);
    }

    public function login($username, $password) {
        try {
            $query = "SELECT id, username, password_hash FROM users WHERE username = :username";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([':username' => $username]);
            $user = $stmt->fetch();
            if($user && password_verify($password, $user['password_hash'])) {
                session_start();
                $_SESSION['username'] = $user['username'];
                $_SESSION['user_id'] = $user['id'];
                header('Location: index.php?action=dashboard');
                exit;
            } else {
                echo "Error";
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}