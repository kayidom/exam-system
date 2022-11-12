<?php

class DBConnection {
    //properties to hold database connection values/credentials
    private $dsn = "mysql:host=localhost;dbname=";
    private $dbname = "oes";//onlineexamportal
    private $username = "root";
    private $password = "";
    private $db = null;

    //connection to database and returns connection object
    private function connectDB() {
        try {
            $this->db = new PDO($this->dsn.$this->dbname, $this->username, $this->password);
        } 
        catch (PDOException $ex) {
            $msg = $ex->getMessage();
            include('views/404.php');
            exit();
        }
        return $this->db;
    }
    //returns database connection object
    public function connect() {
        return $this->connectDB();
    }

}
// $dbConnect = new DBConnection();
// $db = $dbConnect->connect();


?>