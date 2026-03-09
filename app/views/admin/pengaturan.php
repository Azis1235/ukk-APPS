<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan - SchoolVoice</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Inter', sans-serif; }
        body { background-color: #f8fafc; color: #0f172a; line-height: 1.5; }

        /* Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            position: sticky; top: 0; z-index: 50;
        }
        .navbar-inner {
            max-width: 1200px; margin: 0 auto;
            padding: 16px 24px;
            display: flex; justify-content: space-between; align-items: center;
        }
        .logo {
            font-weight: 700; font-size: 18px; color: #0f172a;
            display: flex; align-items: center; gap: 8px; text-decoration: none;
        }
        .logo-box {
            background: #3b82f6; color: white;
            width: 32px; height: 32px; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-weight: 800;
        }
        
        .nav-links { display: flex; gap: 32px; }
        .nav-links a {
            text-decoration: none; color: #64748b; font-weight: 500; font-size: 14px;
            transition: all 0.2s; position: relative;
        }
        .nav-links a:hover { color: #0f172a; }
        .nav-links a.active { color: #3b82f6; font-weight: 700; }
        .nav-links a.active::after {
            content: ''; position: absolute; bottom: -24px; left: 0;
            width: 100%; height: 2px; background: #3b82f6; border-radius: 2px;
        }

        .user-menu { display: flex; align-items: center; gap: 16px; }
        .user-role { font-size: 13px; font-weight: 600; color: #64748b; background: #f1f5f9; padding: 4px 12px; border-radius: 50px; }
        .btn-logout {
            text-decoration: none; color: #ef4444; font-weight: 600; font-size: 13px;
            display: flex; align-items: center; gap: 8px; padding: 8px 16px;
            background: #fef2f2; border: 1px solid #fee2e2; border-radius: 10px;
            transition: all 0.3s ease;
        }
        .btn-logout:hover {
            background: #ef4444; color: white; transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
        }

        /* Main Content */
        .container { max-width: 900px; margin: 40px auto; padding: 0 24px 80px; }
        
        .header-section { margin-bottom: 40px; }
        .header-section h1 { font-size: 32px; font-weight: 800; letter-spacing: -1px; margin-bottom: 8px; }
        .header-section p { color: #64748b; font-size: 16px; }

        /* Card */
        .card { background: white; border-radius: 24px; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); padding: 32px; margin-bottom: 24px; }
        .card-header { position: relative; padding-bottom: 16px; margin-bottom: 24px; border-bottom: 1px solid #f1f5f9; }
        .card-header h3 { font-size: 18px; font-weight: 700; }

        .settings-grid { display: grid; grid-template-columns: 1fr 2fr; gap: 24px; }

        /* Forms */
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 8px; }
        .form-control { width: 100%; padding: 12px 16px; border: 1.5px solid #e2e8f0; border-radius: 12px; font-size: 14px; transition: all 0.2s; }
        .form-control:focus { outline: none; border-color: #3b82f6; box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1); }

        .btn-save { padding: 14px 24px; background: #3b82f6; color: white; border: none; border-radius: 12px; font-weight: 700; font-size: 14px; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 10px; }
        .btn-save:hover { background: #2563eb; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3); }

        /* Alerts */
        .alert { padding: 16px; border-radius: 16px; margin-bottom: 24px; font-size: 14px; font-weight: 600; display: flex; align-items: center; gap: 12px; }
        .alert-success { background: #ecfdf5; color: #059669; border: 1px solid #d1fae5; }
        .alert-error { background: #fef2f2; color: #ef4444; border: 1px solid #fee2e2; }

        /* Profile Info */
        .profile-card { text-align: center; }
        .avatar-large { width: 80px; height: 80px; background: #eff6ff; color: #3b82f6; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 32px; font-weight: 800; margin: 0 auto 16px; border: 2px solid #3b82f6; }
        .profile-name { font-size: 18px; font-weight: 800; color: #0f172a; }
        .profile-username { font-size: 14px; color: #64748b; margin-top: 4px; font-family: monospace; font-weight: 600; }

        /* Animations */
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .fade-in { animation: fadeIn 0.4s ease-out forwards; }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-inner">
            <a href="index.php?page=admin_dashboard" class="logo">
                <div class="logo-box">S</div>
                SchoolVoice
            </a>
            
            <div class="nav-links">
                <a href="index.php?page=admin_dashboard">Dashboard</a>
                <a href="index.php?page=admin_aspirasi">Data Aspirasi</a>
                <a href="index.php?page=admin_users">Data Pengguna</a>
                <a href="index.php?page=admin_categories">Data Kategori</a>
            </div>

            <div class="user-menu">
                <span class="user-role">Administrator</span>
                <a href="index.php?page=logout" class="btn-logout">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                    Logout
                </a>
            </div>
        </div>
    </nav>

    <div class="container fade-in">
        <header class="header-section">
            <h1>Pengaturan Akun</h1>
            <p>Kelola keamanan dan profil administratif anda di satu tempat.</p>
        </header>

        <?php if (isset($success_message)): ?>
            <div class="alert alert-success">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                <?php echo $success_message; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($error_message)): ?>
            <div class="alert alert-error">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <div class="settings-grid">
            <aside>
                <div class="card profile-card">
                    <div class="avatar-large">A</div>
                    <div class="profile-name">Administrator</div>
                    <div class="profile-username">@admin</div>
                    <div style="margin-top: 16px;">
                        <span class="user-role">Sesi Administrator Aktif</span>
                    </div>
                </div>

                <div class="card" style="padding: 24px; margin-top: 24px;">
                    <div class="card-header" style="border: none; margin-bottom: 12px; padding: 0;">
                        <h3 style="font-size: 14px; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.1em;">Tentang</h3>
                    </div>
                    <p style="font-size: 13px; color: #64748b; line-height: 1.6;">
                        <strong>SchoolVoice v1.1.0</strong><br>
                        Sistem Informasi Pengaduan Sarana dan Prasarana Sekolah.
                    </p>
                    <p style="font-size: 12px; color: #cbd5e1; margin-top: 12px;">© 2024 SchoolVoice Team</p>
                </div>
            </aside>

            <main>
                <div class="card">
                    <div class="card-header">
                        <h3>Keamanan Akun</h3>
                    </div>
                    <form action="index.php?page=change_password" method="POST">
                        <div class="form-group">
                            <label>Kata Sandi Baru</label>
                            <input type="password" name="new_password" class="form-control" required placeholder="Masukkan kata sandi baru minimal 6 karakter">
                        </div>
                        <div class="form-group">
                            <label>Konfirmasi Kata Sandi Baru</label>
                            <input type="password" name="confirm_password" class="form-control" required placeholder="Ketik ulang kata sandi baru">
                        </div>
                        <div style="display: flex; justify-content: flex-end; margin-top: 32px;">
                            <button type="submit" class="btn-save">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                                Perbarui Keamanan
                            </button>
                        </div>
                    </form>
                </div>

                <div class="card" style="background: #fffbeb; border: 1px solid #fde68a;">
                    <div style="display: flex; gap: 16px;">
                        <div style="font-size: 24px;">💡</div>
                        <div>
                            <h4 style="font-weight: 700; color: #92400e; margin-bottom: 4px;">Informasi Penting</h4>
                            <p style="font-size: 13px; color: #b45309; line-height: 1.6;">Harap gunakan kombinasi password yang kuat untuk menjaga keamanan data aspirasi sekolah. Jangan berbagi akun administrator dengan pihak lain.</p>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
