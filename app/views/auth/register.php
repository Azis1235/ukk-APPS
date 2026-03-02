<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Anggota Baru - SchoolVoice</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body.register-body {
            background-color: var(--bg-color);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', sans-serif;
            color: var(--text-primary);
        }

        .register-card {
            background: white;
            padding: 48px;
            border-radius: 24px;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
        }

        .reg-icon {
            background: white;
            color: var(--text-primary);
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 32px auto;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        .register-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .register-header h2 {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 8px;
        }

        .register-header p {
            color: var(--text-secondary);
            font-size: 14px;
        }

        .form-group-reg {
            margin-bottom: 20px;
        }

        .form-group-reg label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .form-control-reg {
            width: 100%;
            padding: 12px 16px;
            background: #ffffff;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            color: var(--text-primary);
            font-family: inherit;
            transition: all 0.2s;
            box-sizing: border-box;
        }

        .form-control-reg:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        .btn-reg {
            width: 100%;
            padding: 14px;
            background: var(--sidebar-bg);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 12px;
        }

        .btn-reg:hover {
            background: #334155;
            transform: translateY(-1px);
        }

        .error-msg {
            background: #fff1f2;
            color: #e11d48;
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 14px;
            border: 1px solid #ffe4e6;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
        }

        .success-msg {
            background: #f0fdf4;
            color: #16a34a;
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 14px;
            border: 1px solid #dcfce7;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
        }

        .login-link {
            display: block;
            text-align: center;
            margin-top: 24px;
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 14px;
        }

        .login-link a {
            color: var(--accent);
            font-weight: 600;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .password-container {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--text-secondary);
            background: none;
            border: none;
            padding: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            transition: all 0.2s;
        }

        .toggle-password:hover {
            color: var(--text-primary);
            background: #f1f5f9;
        }
    </style>
</head>
<body class="register-body">
    <div class="register-card fade-in">
        <div class="register-header">
            <div class="reg-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
            </div>
            <h2>Daftar Anggota</h2>
            <p>Buat akun siswa untuk mulai menyampaikan aspirasi</p>
        </div>
        
        <?php if (isset($error_message)): ?>
            <div class="error-msg">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($success_message)): ?>
            <div class="success-msg">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                <?php echo $success_message; ?>
            </div>
        <?php endif; ?>
        
        <form action="index.php?page=do_register" method="POST">
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" class="form-control" required placeholder="Nama sesuai absen">
            </div>
            <div class="form-group">
                <label for="username">Username / NISN</label>
                <input type="text" id="username" name="username" class="form-control" required placeholder="Digunakan untuk login">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <div class="password-container">
                    <input type="password" id="password" name="password" class="form-control" required placeholder="Minimal 6 karakter">
                    <button type="button" class="toggle-password" onclick="togglePasswordVisibility('password', this)" title="Lihat Password">
                        <svg class="eye-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    </button>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; font-size: 16px; margin-top: 20px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                Buat Akun Sekarang
            </button>
        </form>
        
        <div class="login-link" style="margin-top: 32px;">
            <p style="color: var(--text-secondary); font-size: 14px; margin-bottom: 20px;">
                Sudah punya akun? <a href="index.php?page=login_siswa" style="color: var(--accent); font-weight: 700; text-decoration: none; border-bottom: 2px solid transparent; transition: all 0.2s;" onmouseover="this.style.borderBottomColor='var(--accent)';" onmouseout="this.style.borderBottomColor='transparent';">Login di sini</a>
            </p>
            <a href="index.php" style="display: flex; align-items: center; justify-content: center; gap: 8px; color: var(--text-secondary); text-decoration: none; font-size: 13px; font-weight: 600; transition: all 0.2s ease;" onmouseover="this.style.color='var(--text-primary)'; this.style.transform='translateX(-4px)';" onmouseout="this.style.color='var(--text-secondary)'; this.style.transform='translateX(0)';">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                Kembali ke Beranda
            </a>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(fieldId, btn) {
            const passwordInput = document.getElementById(fieldId);
            const icon = btn.querySelector('svg');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>';
                btn.title = "Sembunyikan Password";
            } else {
                passwordInput.type = 'password';
                icon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>';
                btn.title = "Lihat Password";
            }
        }
    </script>
</body>
</html>
