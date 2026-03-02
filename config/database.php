<?php
/**
 * Konfigurasi Database - SchoolVoice
 * 
 * Class ini menangani koneksi ke MySQL menggunakan PDO dengan
 * pengaturan keamanan standar untuk aplikasi web.
 */

require_once __DIR__ . '/config.php';

class Database {
    private $host = DB_HOST;
    private $db_name = DB_NAME;
    private $username = DB_USER;
    private $password = DB_PASS;
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $dsn = "mysql:host=" . $this->host . ";port=" . DB_PORT . ";dbname=" . $this->db_name;
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->exec("set names utf8");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
 
   }
}
?>