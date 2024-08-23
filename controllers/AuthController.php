<?php

require_once 'models/User.php';
class AuthController
{
    // To make the connection with model
    private $model;

    public function __construct()
    {
        // create user model object
        $this->model = new User();
        session_start();
    }

    public function register()
    {
        require 'views/auth/register.php';
    }

    public function login()
    {
        require 'views/auth/login.php';
    }

    public function logout()
    {
        session_destroy();
        header('Location: /');
    }

    public function handleRegister()
    {
        // validation request mehotd
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            require 'views/utilities/404.php';
        }
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $data = ['name' => $name, 'email' => $email, 'password' => $password];
        if (empty($name) || empty($email) || empty($password)) {
            $_SESSION['message'] = 'Data cannot be empty';
            require 'views/auth/register.php';
            return;
        }
        if ($this->model->checkEmailExists($email)) {
            $_SESSION['message'] = 'Email already exists';
            require 'views/auth/register.php';
            return;
        }
        if ($this->model->create($data)) {
            $_SESSION['message'] = 'User has been created';
            header('Location: /login');
            exit;
        }
    }

    public function handleLogin()
    {
        // validation request mehotd
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            require 'views/utilities/404.php';
        }
        $email = $_POST['email'];
        $password = $_POST['password'];
        if (empty($email) || empty($password)) {
            $_SESSION['message'] = 'Data cannot be empty';
            require 'views/auth/login.php';
            return;
        }
        $user = $this->model->findByEmail($email);
        if (!$user) {
            $_SESSION['message'] = 'User not found';
            require 'views/auth/login.php';
            return;
        }
        if (!password_verify($password, $user['password'])) {
            $_SESSION['message'] = 'Incorrect password';
            require 'views/auth/login.php';
            return;
        }
        $_SESSION['user'] = $user;
        header('Location: /');
        exit;
    }
}