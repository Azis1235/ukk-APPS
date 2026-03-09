<?php
/**
 * SiswaController - SchoolVoice
 * 
 * Controller ini menangani aktivitas siswa, seperti melihat riwayat
 * pengaduan mereka dan mengirimkan aspirasi baru beserta unggahan foto.
 */
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/AspirasiModel.php';
require_once __DIR__ . '/../models/KategoriModel.php';

class SiswaController {
    private $aspirasiModel;
    private $kategoriModel;
    private $db;

    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        // Cek login dan role
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'siswa') {
            header("Location: index.php?page=login");
            exit;
        }

        $database = new Database();
        $this->db = $database->getConnection();
        
        // Migration: Expand fotobukti column to accommodate Base64 data
        try {
            $this->db->exec("ALTER TABLE aspirasi MODIFY fotobukti LONGTEXT");
        } catch (Exception $e) {
            // Silently fail if column is already modified or if user lacks permissions
        }

        $this->aspirasiModel = new AspirasiModel($this->db);
        $this->kategoriModel = new KategoriModel($this->db);
    }

    // Menampilkan riwayat aspirasi milik siswa tersebut
    public function index() {
        $aspirasi_list = $this->aspirasiModel->getByUserId($_SESSION['user_id']);
        include __DIR__ . '/../views/siswa/dashboard.php';
    }

    // Menampilkan formulir pendaftaran laporan baru
    public function create() {
        $kategori_list = $this->kategoriModel->getAll();
        include __DIR__ . '/../views/siswa/form_aspirasi.php';
    }

    // Menyimpan data laporan baru ke database (menggunakan Base64 untuk foto)
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user_id = $_SESSION['user_id'];
            $kategori_id = $_POST['kategori_id'];
            $judul = $_POST['judul'];
            $deskripsi = $_POST['deskripsi'];
            $lokasi = $_POST['lokasi'];
            $foto = null;

            // Handle Photo as Base64 (Vercel compatible)
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
                // Limit size to 1MB to avoid database bloat and performance issues
                if ($_FILES['foto']['size'] <= 1048576) {
                    $image_data = file_get_contents($_FILES['foto']['tmp_name']);
                    $base64 = base64_encode($image_data);
                    $mime = $_FILES['foto']['type'];
                    $foto = "data:$mime;base64,$base64";
                }
            }

            if ($this->aspirasiModel->create($user_id, $kategori_id, $judul, $deskripsi, $lokasi, $foto)) {
                header("Location: index.php?page=siswa_dashboard");
            } else {
                echo "Gagal mengirim aspirasi.";
            }
        }
    }
}
?>
