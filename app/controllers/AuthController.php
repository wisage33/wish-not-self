<?php

class AuthController {
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function showRegisterForm() {
        include (__DIR__ . '/../views/register.php');
    }
    
    public function showLoginForm() {
        include (__DIR__ . '/../views/login.php');
    }
    
    public function registerUser() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = htmlspecialchars($_POST['login']);
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            if($this->userModel->register($login, $email, $password)) {
                echo "Success";
                return header("location: index.php?action=login");
            } else {
                echo "Error";
            };
        }
    }

    public function loginUser() {
        if($_SERVER['REQUEST_METHOD'] === 'GET') {
            $login = htmlspecialchars($_GET['login']);
            $password = htmlspecialchars($_GET['password']);
            if($this->userModel->login($login, $password)) {
                header('location: index.php?action=login');
            } else {
                echo "Error";
            }
        }
    }
}