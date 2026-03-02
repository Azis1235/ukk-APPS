<?php
/**
 * Konfigurasi Database - SchoolVoice
 * 
 * Class ini menangani koneksi ke MySQL menggunakan PDO dengan
 * pengaturan keamanan standar untuk aplikasi web.
 */

class Database {
    private $host = "localhost";
    private $db_name = "pengaduan_sekolah";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
 
   }
}
?>