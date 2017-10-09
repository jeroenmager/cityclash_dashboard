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
    
    function del_location($id){
        $this->stmt = $this->dbh->prepare("DELETE FROM Location WHERE idLocation = :id");
        
        $this->stmt->bindValue(':id', $id);
        
        $this->success_message = "Locatie Verwijderd!";
    }
    
    function get_locations(){
        $this->stmt = $this->dbh->prepare("SELECT Location.idLocation, Location.Name, Location.Active, Location.latitude, Location.longitude FROM Location");
    }
    
    function set_question($question, $image, $type, $locID, $answer1, $answer2, $answer3, $answer4){
        $this->stmt = $this->dbh->prepare("INSERT INTO Question (Text, Photo, type, Location_idLocation, answer1, answer2, answer3, "
                . "answer4) VALUES (:vraag, :image, :type, :locID, :answer1, :answer2, :answer3, :answer4)");
        
        $this->stmt->bindValue(':vraag', $question);
        $this->stmt->bindValue(':image', $image);
        $this->stmt->bindValue(':type', $type);
        
        $this->stmt->bindValue(':answer1', $answer1);
        $this->stmt->bindValue(':answer2', $answer2);
        $this->stmt->bindValue(':answer3', $answer3);
        $this->stmt->bindValue(':answer4', $answer4);
        
        $this->stmt->bindValue(':locID', $locID);
        
        $this->success_message = "Vraag is toegevoegd";
    }
    
    function del_question($id){
        $this->stmt = $this->dbh->prepare("DELETE FROM Question WHERE idQuestion = :id");
        
        $this->stmt->bindValue(':id', $id);
        
        $this->success_message = "Vraag is verwijderd";
    }
    
    function del_user($id){
        $this->stmt = $this->dbh->prepare("DELETE FROM User WHERE idUser = :id");
        
        $this->stmt->bindValue(':id', $id);
        
        $this->success_message = "Vraag is verwijderd";
    }
    
    function get_images($id){
        $this->stmt = $this->dbh->prepare("SELECT Question.idQuestion, Question.Photo FROM Question WHERE Question.idQuestion = :id");
        
        $this->stmt->bindValue(':id', $id);
        
        $this->success_message = "Vraag is toegevoegd";
    }
    
    function set_group($Role, $Name, $Password){
        $this->stmt = $this->dbh->prepare("INSERT INTO User (Role, Name, Password) VALUES (:Role, :Name, :Password)");
        
        $this->stmt->bindValue(':Role', $Role);
        $this->stmt->bindValue(':Name', $Name);
        $this->stmt->bindValue(':Password', $Password);
        
        $this->success_message = "Groep is toegevoegd";
    }
    
    function get_groups(){
        $this->stmt = $this->dbh->prepare("SELECT User.idUser, User.Role, User.Name, User.Password, User.Active FROM User");
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
