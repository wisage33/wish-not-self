<?php
spl_autoload_register(function ($class) {
    $paths = [
        __DIR__ . "/app/models/",
        __DIR__ . "/app/controllers/"
    ];

    foreach($paths as $path) {
        $file = $path . $class . ".php";
        if(file_exists($file)) {
            require_once $file;
            return;
        }
    }

    throw new Exception("Class {$class} not found");
});

if(isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'dashboard';
};

$dashboard = new DashboardController;
$auth = new AuthController;

switch ($action) {
    case 'dashboard':
        $dashboard->showDashboard();
        break;
        $dashboard->ordersById(1);
    case 'login':
        $auth->showLoginForm();
        break;
    case 'doLogin':
        $auth->login($_POST['username'], $_POST['password']);
    case 'exit':
        $auth->exit();
        break;
};