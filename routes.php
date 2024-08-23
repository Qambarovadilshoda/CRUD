<?php

require_once 'controllers/HomeController.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/UserController.php';
require_once 'controllers/PostController.php';

$routes = [
    '/' => [
        'controller' => 'HomeController',
        'method' => 'index',
    ],
    '/register' => [
        'controller' => 'AuthController',
        'method' => 'register'
    ],
    '/login' => [
        'controller' => 'AuthController',
        'method' => 'login'
    ],
    '/logout' => [
        'controller' => 'AuthController',
        'method' => 'logout'
    ],
    '/handleRegister' => [
        'controller' => 'AuthController',
        'method' => 'handleRegister'
    ],
    '/handleLogin' => [
        'controller' => 'AuthController',
        'method' => 'handleLogin'
    ],
    '/profile'=> [
        'controller'=> 'UserController',
        'method'=> 'profile'
    ],
    '/profile/edit'=> [
        'controller'=> 'UserController',
        'method'=> 'edit'
    ],
    '/handleEdit'=> [
        'controller'=> 'UserController',
        'method'=> 'handleEdit'
    ],
    '/posts' => [
        'controller'=> 'PostController',
        'method'=> 'index'
    ],
    '/handleCreate'=> [
        'controller'=> 'PostController',
        'method'=> 'handleCreate'
    ],
    '/handleRead'=> [
        'controller'=> 'PostController',
        'method'=> 'handleRead'
    ],
    '/handlePostEdit'=> [
        'controller'=> 'PostController',
        'method'=> 'handlePostEdit'
    ],
    '/handleDelete'=> [
        'controller'=> 'PostController',
        'method'=> 'handleDelete'
    ],
    '/findPost'=> [
        'controller'=> 'PostController',
        'method'=> 'findPost'
    ],
];
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); 
$route = $routes[$url];

if ($route) {
    $controller = new $route['controller'](); 
    $method = $route['method'];
    $controller->$method(); // $controller->index()
} else {
    header("HTTP/1.0 404 Not Found");
    require 'views/utilities/404.php';
}