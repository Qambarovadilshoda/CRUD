<?php
require_once ("Model.php");
class Post extends Model
{
    public function __construct()
    {
        parent::__construct('posts'); // Pass the table name to the parent constructor
    }
    
}