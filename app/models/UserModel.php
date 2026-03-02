<?php
/**
 * Model User - SchoolVoice
 * 
 * Class ini menangani semua data terkait pengguna (admin & siswa),
 * termasuk sistem login, pendaftaran akun, dan manajemen profil.
 */
class UserModel {
    private $conn;
    private $table_name = "users";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Otentikasi pengguna menggunakan username dan kata sandi (MD5)
    public function login($username, $password) {
        $query = "SELECT id_user as id, username, password_md5 as password, role, nama as nama_lengkap FROM " . $this->table_name . " WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($query);
        
        $username = htmlspecialchars(strip_tags($username));
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // Verify password - using MD5 as requested
            if (md5($password) == $row['password']) {
                return $row;
            }
        }
        return false;
    }

    // Mengambil profil pengguna tunggal berdasarkan ID
    public function getUserById($id) {
        $query = "SELECT id_user as id, username, role, nama as nama_lengkap FROM " . $this->table_name . " WHERE id_user = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Get all users
    public function getAll() {
        $query = "SELECT id_user as id, nama as nama_lengkap, username, role FROM " . $this->table_name . " ORDER BY role ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Create user
    // Menambahkan akun pengguna baru ke sistem
    public function create($username, $password, $role, $nama_lengkap) {
        $query = "INSERT INTO " . $this->table_name . " (username, password_md5, role, nama) VALUES (:username, :password, :role, :nama)";
        $stmt = $this->conn->prepare($query);
        
        $hashed_password = md5($password);

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $hashed_password);
        $stmt->bindParam(":role", $role);
        $stmt->bindParam(":nama", $nama_lengkap);

        return $stmt->execute();
    }

    // Delete user
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_user = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    // Change Password
    public function changePassword($id, $new_password) {
        $query = "UPDATE " . $this->table_name . " SET password_md5 = :password WHERE id_user = :id";
        $stmt = $this->conn->prepare($query);
        
        $hashed_password = md5($new_password);
        
        $stmt->bindParam(":password", $hashed_password);
        $stmt->bindParam(":id", $id);
        
        return $stmt->execute();
    }
    // Update user
    public function update($id, $username, $role, $nama_lengkap, $password = null) {
        if (!empty($password)) {
            $query = "UPDATE " . $this->table_name . " SET username = :username, role = :role, nama = :nama, password_md5 = :password WHERE id_user = :id";
            $stmt = $this->conn->prepare($query);
            $hashed_password = md5($password);
            $stmt->bindParam(":password", $hashed_password);
        } else {
            $query = "UPDATE " . $this->table_name . " SET username = :username, role = :role, nama = :nama WHERE id_user = :id";
            $stmt = $this->conn->prepare($query);
        }

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":role", $role);
        $stmt->bindParam(":nama", $nama_lengkap);
        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }
}
?>
