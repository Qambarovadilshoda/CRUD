<?php

class HomeController
{
    public function __construct()
    {
        session_start();
    }
    public function index()
    {
        $user = $_SESSION['user'];
        if ($user) {
            require 'views/home.php';
        } else {
            header('Location: /login');
        }

    }
}