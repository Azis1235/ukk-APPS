<?php
/**
 * SchoolVoice - Sistem Aspirasi & Pengaduan Sekolah
 * 
 * File ini berfungsi sebagai router utama (Front Controller) yang menangani
 * semua permintaan URL dan mengarahkannya ke controller yang sesuai.
 */

$page = (isset($_GET['page']) && $_GET['page'] !== '' && $_GET['page'] !== 'index.php') ? rtrim($_GET['page'], '/') : 'home';

switch ($page) {
    case 'home':
        require_once 'app/views/home.php';
        break;

    // --- Bagian Autentikasi ---
    case 'register':
        require_once 'app/views/auth/register.php';
        break;

    case 'do_register':
        require_once 'app/controllers/AuthController.php';
        $auth = new AuthController();
        $auth->doRegister();
        break;

    case 'login_admin':
        require_once 'app/views/auth/login_admin.php';
        break;

    case 'login_siswa':
        require_once 'app/views/auth/login_siswa.php';
        break;
        
    case 'do_login':
        require_once 'app/controllers/AuthController.php';
        $auth = new AuthController();
        $auth->login();
        break;
        
    case 'logout':
        require_once 'app/controllers/AuthController.php';
        $auth = new AuthController();
        $auth->logout();
        break;

    // --- Bagian Khusus Siswa ---
    case 'siswa_dashboard':
        require_once 'app/controllers/SiswaController.php';
        $siswa = new SiswaController();
        $siswa->index();
        break;
        
    case 'tambah_aspirasi':
        require_once 'app/controllers/SiswaController.php';
        $siswa = new SiswaController();
        $siswa->create();
        break;
        
    case 'store_aspirasi':
        require_once 'app/controllers/SiswaController.php';
        $siswa = new SiswaController();
        $siswa->store();
        break;

    // --- Bagian Khusus Administrator ---
    case 'admin_dashboard':
        require_once 'app/controllers/AdminController.php';
        $admin = new AdminController();
        $admin->index();
        break;
        
    case 'update_status':
        require_once 'app/controllers/AdminController.php';
        $admin = new AdminController();
        $admin->updateStatus();
        break;

    case 'admin_aspirasi':
        require_once 'app/controllers/AdminController.php';
        $admin = new AdminController();
        $admin->aspirasi();
        break;

    case 'delete_aspirasi':
        require_once 'app/controllers/AdminController.php';
        $admin = new AdminController();
        $admin->deleteAspirasi();
        break;

    case 'admin_users':
        require_once 'app/controllers/AdminController.php';
        $admin = new AdminController();
        $admin->users();
        break;
        
    case 'store_user':
        require_once 'app/controllers/AdminController.php';
        $admin = new AdminController();
        $admin->storeUser();
        break;
        
    case 'update_user':
        require_once 'app/controllers/AdminController.php';
        $admin = new AdminController();
        $admin->updateUser();
        break;
        
    case 'delete_user':
        require_once 'app/controllers/AdminController.php';
        $admin = new AdminController();
        $admin->deleteUser();
        break;

    case 'admin_settings':
        require_once 'app/controllers/AdminController.php';
        $admin = new AdminController();
        $admin->settings();
        break;

    case 'change_password':
        require_once 'app/controllers/AdminController.php';
        $admin = new AdminController();
        $admin->changePassword();
        break;

    default:
        echo "404 Page Not Found";
        break;
}
?>
