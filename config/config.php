<?php
/**
 * Global Configuration - SchoolVoice
 * 
 * Sesuaikan nilai di bawah ini dengan konfigurasi hosting Anda.
 */

define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_NAME', getenv('DB_NAME') ?: 'pengaduan_sekolah');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');
define('DB_PORT', getenv('DB_PORT') ?: '3306');

// Base URL (opsional, untuk membantu routing jika diperlukan)
// define('BASE_URL', 'https://domainanda.com/');
?>
