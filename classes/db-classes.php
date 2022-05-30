<?php

class Db {
    protected function connect(){
        try{
            $username = "root";
            $password = "";
            $db = new PDO("mysql:host=localhost;dbname=final", $username, $password);
            return $db;

        }catch(PDOException $e){
            echo "Error!: ". $e->getMessage();
            die();
        }
    }
    
    public function create_db(){
        $db = new Db();
        $db = $db->connect();
        return $db;
    }
}