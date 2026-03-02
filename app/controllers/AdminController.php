<?php
/**
 * AdminController - SchoolVoice
 * 
 * Controller ini menangani semua logika bisnis untuk fitur administrator,
 * termasuk manajemen dashboard, pemrosesan aspirasi, dan manajemen pengguna.
 */
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/AspirasiModel.php';
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../models/KategoriModel.php';

class AdminController {
    private $aspirasiModel;
    private $db;

    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: index.php?page=login");
            exit;
        }

        $database = new Database();
        $this->db = $database->getConnection();
        $this->aspirasiModel = new AspirasiModel($this->db);
    }

    // Menampilkan halaman utama dashboard dengan statistik laporan
    public function index() {
        $aspirasi_list = $this->aspirasiModel->getAll();
        $stats = $this->aspirasiModel->getStatistics();
        include __DIR__ . '/../views/admin/dashboard.php';
    }

    public function updateStatus() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['aspirasi_id'];
            $status = $_POST['status'];
            $feedback = $_POST['feedback'];
            $admin_id = $_SESSION['user_id'];

            // Update status
            $this->aspirasiModel->updateStatus($id, $status);

            // Add feedback if provided
            if (!empty($feedback)) {
                $query = "INSERT INTO feedback (id_aspirasi, id_user, pesan, tanggal) VALUES (:aspirasi_id, :admin_id, :pesan, NOW())";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(":aspirasi_id", $id);
                $stmt->bindParam(":admin_id", $admin_id);
                $stmt->bindParam(":pesan", $feedback);
                $stmt->execute();
            }

            header("Location: index.php?page=admin_dashboard");
        }
    }

    // Menampilkan daftar aspirasi lengkap dengan fitur filter
    public function aspirasi() {
        $category = isset($_GET['category']) ? $_GET['category'] : null;
        $date = isset($_GET['date']) ? $_GET['date'] : null;
        $month = isset($_GET['month']) ? $_GET['month'] : null;
        $year = isset($_GET['year']) ? $_GET['year'] : null;

        if ($category || $date || $month || $year) {
            $aspirasi_list = $this->aspirasiModel->getFiltered($category, $date, $month, $year);
        } else {
            $aspirasi_list = $this->aspirasiModel->getAll();
        }

        $kategoriModel = new KategoriModel($this->db);
        $categories = $kategoriModel->getAll();
        
        include __DIR__ . '/../views/admin/aspirasi.php';
    }

    // Mengelola data pengguna (Admin/Siswa) yang terdaftar
    public function users() {
        $database = new Database();
        $userModel = new UserModel($database->getConnection());
        $users = $userModel->getAll();
        include __DIR__ . '/../views/admin/users.php';
    }
    
    public function storeUser() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $database = new Database();
            $userModel = new UserModel($database->getConnection());
            
            $username = $_POST['username'];
            $password = $_POST['password'];
            $role = $_POST['role'];
            $nama = $_POST['nama_lengkap'];
            
            $userModel->create($username, $password, $role, $nama);
            header("Location: index.php?page=admin_users");
        }
    }

    public function updateUser() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $database = new Database();
            $userModel = new UserModel($database->getConnection());
            
            $id = $_POST['user_id'];
            $username = $_POST['username'];
            $role = $_POST['role'];
            $nama = $_POST['nama_lengkap'];
            $password = !empty($_POST['password']) ? $_POST['password'] : null;
            
            $userModel->update($id, $username, $role, $nama, $password);
            header("Location: index.php?page=admin_users");
        }
    }
    
    public function deleteUser() {
        if (isset($_GET['id'])) {
            $database = new Database();
            $userModel = new UserModel($database->getConnection());
            $userModel->delete($_GET['id']);
            header("Location: index.php?page=admin_users");
        }
    }

    public function settings() {
        include __DIR__ . '/../views/admin/pengaturan.php';
    }

    public function changePassword() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $database = new Database();
            $userModel = new UserModel($database->getConnection());
            
            $id = $_SESSION['user_id'];
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];
            
            if ($new_password === $confirm_password) {
                // In a real app we should check old password too, simplified here
                $userModel->changePassword($id, $new_password);
                $success_message = "Password berhasil diubah!";
            } else {
                $error_message = "Konfirmasi password tidak sesuai!";
            }
            
            include __DIR__ . '/../views/admin/pengaturan.php';
        }
    }
    public function deleteAspirasi() {
        if (isset($_GET['id'])) {
            $this->aspirasiModel->delete($_GET['id']);
            header("Location: index.php?page=admin_aspirasi");
        }
    }
}
?>
