<?php
class KategoriModel {
    private $conn;
    private $table_name = "kategori";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT id_kategori as id, nama_kategori FROM " . $this->table_name . " ORDER BY nama_kategori ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
