<?php
class Database {

    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db   = "quanlybanhang";
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);

        if ($this->conn->connect_error) {
            die("Kết nối thất bại: " . $this->conn->connect_error);
        }

        mysqli_set_charset($this->conn, "utf8");
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>
