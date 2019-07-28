<?php
namespace MVC_project\model;



class Manager
{
    protected function dbConnect()
    { 
        $db = new \PDO('mysql:host=localhost;dbname=chat_v1;charset=utf8', 'root', 'root');

        return $db;
    }

}