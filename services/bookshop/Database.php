<?php

require_once "config.php";

class Database {

    private $host;

    private $port;

    private $database;

    private $username;

    private $password;

    public function __construct() {
        $this->host = HOST;
        $this->port = PORT;
        $this->database = DATABASE;
        $this->username = USERNAME;
        $this->password = PASSWORD;
    }

    public function connect()
    {
        try {
            $conn = new PDO(
                "pgsql:host=$this->host;port=$this->port;dbname=$this->database",
                $this->username,
                $this->password,
                ["sslmode"  => "prefer"]
            );

            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }
        catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}