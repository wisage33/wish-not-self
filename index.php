<?php
spl_autoload_register(function ($class) {
    $modelPath = __DIR__ . "/app/models/" . $class . ".php";
    if(file_exists($modelPath)) {
        require_once($modelPath);
        return;
    }
    $controllerPath = __DIR__ . "/app/controllers/" . $class . ".php";
    if(file_exists($controllerPath)) {
        require_once($controllerPath);
        return;
    }
});

if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'register';
}

var_dump($action);

$controller = new AuthController();

switch ($action) {
    case 'login':
        $controller->showLoginForm();
        break;
    case 'register':
        $controller->showRegisterForm();
        break;
    case 'doRegister':
        echo 
        $controller->registerUser();
};

