<?php

session_start();

require_once __DIR__ . '/../config/database.php';

require_once __DIR__ . '/../app/models/User.php';

require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/UserController.php'; 

$page = $_GET['page'] ?? 'home'; 

$authController = new Authcontroller();
$userController = new UserController();

switch($page) {
    case 'login' : 
        $authController->login();
        break;
    case 'login-submit':
        $authController->loginSubmit();
        break;
    case 'logout' :
        $authController->logout();
        break;
    case 'register' :
        $authController->register();
        break;
    case 'register-submit':
        $authController->registerSubmit();
        break;
    //user management
    case 'users' :
    case 'home' :
        $userController->index();
        break;
    case 'user-create' :
        $userController->create();
        break;
    case 'user-store' :
        $userController->store();
        break;
    case 'user-edit' :
        $userController->edit();
        break;
    case 'user-edit':
        $userController->update();
        break;
    case 'user-update':
        $userController->update();
        break;
    case 'user-delete':
        $userController->delete();
        break;
    //fallback
    default:
         http_response_code(404);
         echo "<h1>404 - Page not Found</h1>";
         break;
}