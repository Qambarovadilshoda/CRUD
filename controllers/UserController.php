<?php

class UserController{
    private $model;
    public function __construct() {
        $this->model = new User();
        session_start();   
    }
    public function profile(){
        $user = $_SESSION['user'];
        if ($user) {
            require_once 'views/user/profile.php';
        } else {
            header('Location: /login');
        }
    }
    public function edit(){
        require_once 'views/user/edit.php';
    }
    public function handleEdit(){
        $name = htmlspecialchars(trim($_POST['name']), ENT_QUOTES, 'UTF-8');
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        if($name !== false && $email !== false){
            $data = ['name' => $name,'email'=> $email]; 
            $this->model->update($_SESSION['user']['id'], $data);
            $data['id'] = $_SESSION['user']['id'];
            $_SESSION['user'] = $data;
            header('Location: /profile');
            exit;
        }else{
            die('Ma\'lumotlaringizni to\'g\'ri kiriting');
        }
    }
}