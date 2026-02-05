<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

class Database {
    private $host = "localhost";
    private $db_name = "hospital_db";
    private $username = "root";
    private $password = "200323"; // your MySQL password
    private $port = 3308;         // change if needed
    public $conn;

    public function connect() {
        $this->conn = new mysqli(
            $this->host,
            $this->username,
            $this->password,
            $this->db_name,
            $this->port
        );
        return $this->conn;
    }
}
