<?php

class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "brief9";
    private $cnx;

    public function __construct() {
        try {
            $this->cnx = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->cnx;
    }
}

?>
