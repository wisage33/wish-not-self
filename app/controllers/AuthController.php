<?php

class AuthController {
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function showLoginForm() {
        session_start();
        include(__DIR__ . "/../views/login.php");
    }

    public function login($username, $password) {
        // print_r($_POST);
        $this->userModel->login($username, $password);
    }

    public function exit() {
        session_destroy();
        header('Location: index.php?action=login');
        exit;
    }
}