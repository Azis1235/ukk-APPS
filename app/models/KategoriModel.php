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

    public function create($nama) {
        $query = "INSERT INTO " . $this->table_name . " (nama_kategori) VALUES (:nama)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nama", $nama);
        return $stmt->execute();
    }

    public function update($id, $nama) {
        $query = "UPDATE " . $this->table_name . " SET nama_kategori = :nama WHERE id_kategori = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nama", $nama);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_kategori = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>
