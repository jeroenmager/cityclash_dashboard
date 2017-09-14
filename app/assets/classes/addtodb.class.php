<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of addtodb
 *
 * @author rickb
 */
class Database {
    
//    Database variablen
    private $host      = DB_HOST;
    private $user      = DB_USER;
    private $pass      = DB_PASS;
    private $dbname    = DB_NAME;

    private $dbh;
    private $error;
    private $success_message;
    
    private $stmt;

    public function __construct(){
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT    => true,
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
        );
        // Create a new PDO instanace
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        }
        // Catch any errors
        catch(PDOException $e){
            $this->error = $e->getMessage();
        }
    }
    
    function set_location($lNaam, $lLat, $lLng){
        $this->stmt = $this->dbh->prepare("INSERT INTO Location (latitude, longitude, Name) 
        VALUES (:locLat, :locLng, :locName)");
        
        $this->stmt->bindValue(':locLat', $lLat);
        $this->stmt->bindValue(':locLng', $lLng);
        $this->stmt->bindValue(':locName', $lNaam);
        
        $this->success_message = "Locatie is toegevoegd";
    }
    
    function set_question($question, $image, $type){
        $this->stmt = $this->dbh->prepare("INSERT INTO Question (Text, Photo, type) VALUES (:vraag, :image, :type)");
        
        $this->stmt->bindValue(':vraag', $question);
        $this->stmt->bindValue(':image', $image);
        $this->stmt->bindValue(':type', $type);
        
        $this->success_message = "Vraag is toegevoegd";
    }
    
    function del_question($id){
        $this->stmt = $this->dbh->prepare("DELETE FROM Question WHERE idQuestion = :id");
        
        $this->stmt->bindValue(':id', $id);
        
        $this->success_message = "Vraag is verwijderd";
    }
    
    function get_images($id){
        $this->stmt = $this->dbh->prepare("SELECT Question.idQuestion, Question.Photo FROM Question WHERE Question.idQuestion = :id");
        
        $this->stmt->bindValue(':id', $id);
        
        $this->success_message = "Vraag is toegevoegd";
    }
    
    function db_execute(){
        $this->stmt->execute();
        return $this->success_message;
    }
    
    public function resultset(){
        $this->stmt->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
}
    
    function generate_message($message){
        return $message;
    }
}
