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

    // Menyimpan data laporan baru ke database (termasuk upload foto)
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user_id = $_SESSION['user_id'];
            $kategori_id = $_POST['kategori_id'];
            $judul = $_POST['judul'];
            $deskripsi = $_POST['deskripsi'];
            $lokasi = $_POST['lokasi'];
            $foto = null;

            // Upload foto jika ada
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
                $target_dir = "public/uploads/";
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                $file_name = time() . "_" . basename($_FILES["foto"]["name"]);
                $target_file = $target_dir . $file_name;
                
                if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                    $foto = $file_name;
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
