<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan - Admin</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="logo-box">S</div>
                <h2>SchoolVoice</h2>
            </div>
            <nav>
                <a href="index.php?page=admin_dashboard">
                    <span>📊</span> Dashboard
                </a>
                <a href="index.php?page=admin_aspirasi">
                    <span>📁</span> Data Aspirasi
                </a>
                <a href="index.php?page=admin_users">
                    <span>👥</span> Data Pengguna
                </a>
                <a href="index.php?page=admin_settings" class="active">
                    <span>⚙️</span> Pengaturan
                </a>
                <a href="index.php?page=logout" style="margin-top: auto; background: rgba(239, 68, 68, 0.1); color: #fca5a5;" onmouseover="this.style.background='rgba(239, 68, 68, 0.2)'; this.style.color='white';" onmouseout="this.style.background='rgba(239, 68, 68, 0.1)'; this.style.color='#fca5a5';">
                    <span>🚪</span> Logout
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="dashboard-header fade-in">
                <div>
                    <h1>Pengaturan</h1>
                    <p>Kelola profil dan keamanan akun anda.</p>
                </div>
            </header>

            <?php if (isset($success_message)): ?>
                <div style="background: #d1fae5; color: #059669; padding: 12px; border-radius: 8px; margin-bottom: 24px; border: 1px solid #a7f3d0; font-weight: 500;">
                    ✅ <?php echo $success_message; ?>
                </div>
            <?php endif; ?>

            <?php if (isset($error_message)): ?>
                <div style="background: #fef2f2; color: #b91c1c; padding: 12px; border-radius: 8px; margin-bottom: 24px; border: 1px solid #fecaca; font-weight: 500;">
                    ⚠️ <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 24px;">
                <!-- Profile Summary Card -->
                <div class="card-base fade-in">
                    <div style="text-align: center; padding: 20px 0;">
                        <div style="width: 80px; height: 80px; background: var(--sidebar-bg); color: white; border-radius: 50%; font-size: 32px; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px auto; font-weight: 700;">
                            A
                        </div>
                        <h3 style="font-size: 18px; font-weight: 700; color: var(--text-primary); margin-bottom: 4px;">Administrator</h3>
                        <p style="color: var(--text-secondary); font-size: 14px; margin-bottom: 16px;">admin</p>
                        <span class="badge badge-admin">Admin Role</span>
                    </div>
                </div>

                <!-- Password Change Form -->
                <div class="card-base fade-in">
                    <h3 style="margin-bottom: 24px; font-weight: 600; padding-bottom: 16px; border-bottom: 1px solid #f3f4f6;">Ganti Password</h3>
                    <form action="index.php?page=change_password" method="POST">
                        <div class="form-group">
                            <label>Password Baru</label>
                            <input type="password" name="new_password" class="form-control" required placeholder="Masukkan password baru">
                        </div>
                        <div class="form-group">
                            <label>Konfirmasi Password</label>
                            <input type="password" name="confirm_password" class="form-control" required placeholder="Ulangi password baru">
                        </div>
                        <div style="text-align: right; margin-top: 24px;">
                            <button type="submit" class="btn btn-primary">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card-base fade-in" style="margin-top: 24px;">
                <h3 style="margin-bottom: 16px; font-weight: 600;">Tentang Aplikasi</h3>
                <div style="display: flex; align-items: start; gap: 16px;">
                    <div style="width: 40px; height: 40px; background: #e0f2fe; color: #0284c7; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px;">ℹ️</div>
                    <div>
                        <p style="font-weight: 600; color: var(--text-primary);">APPSS v1.0 (Aplikasi Pengaduan Sarana Sekolah)</p>
                        <p style="color: var(--text-secondary); font-size: 13px; line-height: 1.6; margin-top: 4px;">
                            Sistem ini dibuat untuk memudahkan pengelolaan laporan kerusakan sarana dan prasarana sekolah.<br>
                            Dikembangkan menggunakan <strong>PHP Native 8.x</strong> dan <strong>MySQL</strong>.
                        </p>
                        <p style="margin-top: 12px; font-size: 12px; color: #9ca3af;">&copy; 2024 School Admin System. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
