<?php
/**
 * AuthController - SchoolVoice
 * 
 * Controller ini mengelola proses autentikasi pengguna, mulai dari login,
 * registrasi siswa baru, hingga proses logout dan manajemen sesi.
 */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/UserModel.php';

class AuthController {
    private $userModel;
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->userModel = new UserModel($this->db);
    }

    // Memproses formulir login dan memvalidasi sesi pengguna
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $role_expectation = isset($_POST['role_expectation']) ? $_POST['role_expectation'] : null;

            $user = $this->userModel->login($username, $password);

            if ($user) {
                // Check if user role matches the intended login page
                if ($role_expectation && $user['role'] !== $role_expectation) {
                    $error_message = "Akun anda adalah " . ucfirst($user['role']) . ". Silahkan login di halaman yang sesuai.";
                } else {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['role'] = $user['role'];
                    $_SESSION['nama_lengkap'] = $user['nama_lengkap'];

                    if ($user['role'] == 'admin') {
                        header("Location: index.php?page=admin_dashboard");
                    } else {
                        header("Location: index.php?page=siswa_dashboard");
                    }
                    exit;
                }
            } else {
                $error_message = "Username atau password salah!";
            }

            // Show appropriate login view with error message
            if ($role_expectation == 'admin') {
                require_once __DIR__ . '/../views/auth/login_admin.php';
            } elseif ($role_expectation == 'siswa') {
                require_once __DIR__ . '/../views/auth/login_siswa.php';
            } else {
                require_once __DIR__ . '/../views/auth/register.php';
            }
        }
    }

    // Mendaftarkan akun siswa baru ke dalam database
    public function doRegister() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama = $_POST['nama'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $role = 'siswa'; // Registration is for students only

            // Simple validation
            if (empty($nama) || empty($username) || empty($password)) {
                $error_message = "Semua field harus diisi!";
                require_once __DIR__ . '/../views/auth/register.php';
                return;
            }

            if ($this->userModel->create($username, $password, $role, $nama)) {
                $success_message = "Pendaftaran berhasil! Silahkan login.";
                require_once __DIR__ . '/../views/auth/login_siswa.php';
            } else {
                $error_message = "Gagal mendaftar. Username mungkin sudah digunakan.";
                require_once __DIR__ . '/../views/auth/register.php';
            }
        }
    }

    // Menghapus sesi dan mengarahkan kembali ke beranda
    public function logout() {
        session_destroy();
        header("Location: index.php");
        exit;
    }
}
?>
