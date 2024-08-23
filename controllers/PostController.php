<?php
require_once 'models/Post.php';
class PostController{
    private $model;
    public function __construct() {
        $this->model = new Post();
        session_start();   
    }
    public function index(){
        // $post = $_SESSION['post'];
        require_once 'views/posts/index.php';
    }
    public function handleCreate(){
        $title = $_POST['title'];
        $content = $_POST['content'];
        $author_name = $_SESSION['user']['name'];
        if(!empty($title) && !empty($content) && isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK){
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            if(is_array($allowedExtensions)){
            $image = $_FILES['image']['name'];
            $target = "uploads/".basename($image);
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)){
                $data = [
                    'title'=> $title,
                    'content'=> $content,
                    'image'=> $target,
                    'author_name' => $author_name

                ];
                $this->model->create($data);
                header('Location: /posts');
            }else{
                die('Rasmni yuklashda xatolik!');
            }
            }else{
                die('Faqat jpg, jpeg, png formatdagi fayllar yuklanadi!');
            }
        }else{
            die('Bo\'sh qoldirmang');
        }
    }
    public function handleRead(){ 
        $posts = $this->model->all();
        $_SESSION['post'] = $posts;
        echo "<h1>Posts</h1>";
        if($posts){
            foreach($posts as $post){
                echo "• Title: " . $post['title'] . "<br>";
                echo "• Content: " . $post['content'] . "<br>";
                echo "• Image: <img src='" . $post['image'] . "' alt='Photo' width='100px'height='100px'><br>";
                echo "• Author: " . $post['author_name'] . "<br>";
                echo "• Created: " . $post['created_at'] . "<br>";
                echo "• Updated: " . $post['updated_at'] . "<br><br>";
                echo "<a href='/handlePostEdit?id=" . $post['id'] . "'>Edit</a>" . "\t";
                echo "<a href='/handleDelete?id=" . $post['id'] . "'>Delete</a><hr>";
            }
        }
    }
    public function handlePostEdit() {
        $id = $_GET['id'];
        $post = $this->model->find($id);
        require 'views/posts/edit.php';
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $newTitle = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
            $newContent = $_POST['content'];
            $updatedAtt = date('Y-m-d H:i:s');
            
            if ($post && $post['id'] == $id) {
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $allowedExtensions = ['jpg', 'png', 'jpeg'];
                    $fileExtension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    
                    if (in_array($fileExtension, $allowedExtensions)) {
                        $target = 'uploads/';
                        $newFilename = $_FILES['image']['name'];
                        $targetFile = $target . $newFilename;
    
                        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                            if (file_exists($post['image'])) {
                                unlink($post['image']);
                            }
                            $post['image'] = $targetFile;
                        }
                    }
                }
    
                $data = [
                    'title' => $newTitle,
                    'content' => $newContent,
                    'image' => $post['image'],
                    'updated_at' => $updatedAtt
                ];
                //var_dump($data);
                // var_dump($id);
                // die();
    
                $this->model->update($id, $data);
                //$result = 
                // var_dump($result);
                // die();
                header('Location: /handleRead');
                exit;
            } else {
                die('Post not found or incorrect request.');
            }
        }
    }
        
    public function findPost(){
        $id = $_GET["id"];        
        $post = $this->model->find($id);
        if ($post && $post["id"] == $id) {
            require 'views/posts/find.php';


            echo "• Title: " . $post['title'] . "<br>";
            echo "• Content: " . $post['content'] . "<br>";
            echo "• Image: <img src='" . $post['image'] . "' alt='Photo' width='100px'height='100px'><br>";
            echo "• Author: " . $post['author_name'] . "<br>";
            echo "• Created: " . $post['created_at'] . "<br>";
            echo "• Updated: " . $post['updated_at'] . "<br><br>";
            echo "<a href='/handlePostEdit?id=". $post['id']. "'>Edit</a><br>" . "\t";
            echo "<a href='/handleDelete" . $post['id'] . "'>Delete</a><br>";
            echo "<a href='/posts'>Back</a>";
        }
    }
    public function handleDelete(){
        $id = $_GET["id"];
        $post = $this->model->find($id);
        if ($post && $post["id"] == $id) {
            $this->model->delete($id);
            if(file_exists($post['image'])) {
                unlink($post['image']);
            }
        }
        header('Location: /handleRead');
        exit;
    }
        
}