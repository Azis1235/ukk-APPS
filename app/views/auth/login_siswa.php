<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa - SchoolVoice</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0ea5e9;
            --glass-bg: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
            --glass-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
        }

        body.login-siswa {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Outfit', sans-serif;
            background: #0f172a;
            position: relative;
            overflow: hidden;
            color: #f8fafc;
        }

        /* Animated Background Elements */
        .blob {
            position: absolute;
            filter: blur(80px);
            z-index: 0;
            border-radius: 50%;
            animation: float 10s infinite ease-in-out alternate;
        }

        .blob-1 {
            width: 400px;
            height: 400px;
            background: rgba(14, 165, 233, 0.35); /* Sky Blue */
            top: -100px;
            right: -100px;
        }

        .blob-2 {
            width: 300px;
            height: 300px;
            background: rgba(16, 185, 129, 0.3); /* Emerald */
            bottom: -50px;
            left: -50px;
            animation-delay: -5s;
        }
        
        .blob-3 {
            width: 350px;
            height: 350px;
            background: rgba(99, 102, 241, 0.25); /* Indigo */
            bottom: 20%;
            right: 20%;
            animation-duration: 15s;
        }

        @keyframes float {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(-30px, 50px) scale(1.1); }
        }

        .login-card-siswa {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            padding: 48px;
            border-radius: 24px;
            width: 100%;
            max-width: 420px;
            box-shadow: var(--glass-shadow);
            z-index: 1;
            position: relative;
        }

        .siswa-icon {
            background: linear-gradient(135deg, #0ea5e9, #10b981);
            color: white;
            width: 64px;
            height: 64px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 32px auto;
            box-shadow: 0 10px 25px -5px rgba(14, 165, 233, 0.5);
            position: relative;
        }
        
        .siswa-icon::after {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: 24px;
            background: linear-gradient(135deg, #0ea5e9, #10b981);
            filter: blur(12px);
            opacity: 0.5;
            z-index: -1;
        }

        .login-siswa h2 {
            font-size: 28px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 8px;
            text-align: center;
            letter-spacing: -0.5px;
        }

        .login-siswa p {
            color: #94a3b8;
            font-size: 15px;
            text-align: center;
            margin-bottom: 40px;
            font-weight: 300;
        }

        .form-group-siswa {
            margin-bottom: 24px;
        }

        .form-group-siswa label {
            display: block;
            margin-bottom: 10px;
            font-size: 14px;
            font-weight: 500;
            color: #e2e8f0;
            letter-spacing: 0.5px;
        }

        .form-control-siswa {
            width: 100%;
            padding: 14px 18px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            color: #ffffff;
            font-family: inherit;
            font-size: 15px;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .form-control-siswa::placeholder {
            color: #64748b;
        }

        .form-control-siswa:focus {
            outline: none;
            border-color: rgba(255, 255, 255, 0.3);
            background: rgba(255, 255, 255, 0.08);
            box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.15);
        }

        .btn-siswa {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #0ea5e9, #2563eb);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
        }
        
        .btn-siswa::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: all 0.5s ease;
        }

        .btn-siswa:hover::before {
            left: 100%;
        }

        .btn-siswa:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(14, 165, 233, 0.4);
        }

        .error-msg, .success-msg {
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .error-msg {
            background: rgba(225, 29, 72, 0.1);
            color: #fda4af;
            border: 1px solid rgba(225, 29, 72, 0.2);
        }

        .success-msg {
            background: rgba(22, 163, 74, 0.1);
            color: #86efac;
            border: 1px solid rgba(22, 163, 74, 0.2);
        }

        .back-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 32px;
            color: #94a3b8;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            color: #ffffff;
            transform: translateX(-4px);
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
            color: #94a3b8;
            background: none;
            border: none;
            padding: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .toggle-password:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.1);
        }
        
        .fade-in {
            animation: fadeIn 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
            transform: translateY(20px);
        }
        
        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body class="login-siswa">
    <!-- Animated Background Blobs -->
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>

    <div class="login-card-siswa fade-in">
        <div class="siswa-icon">
            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
        </div>
        <h2>Halo, Siswa!</h2>
        <p>Gunakan akun pelajar untuk menyampaikan aspirasi</p>
        
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
        
        <form action="index.php?page=do_login" method="POST">
            <input type="hidden" name="role_expectation" value="siswa">
            <div class="form-group-siswa">
                <label for="username">NISN / Username</label>
                <input type="text" id="username" name="username" class="form-control-siswa" required placeholder="Masukkan NISN atau Username">
            </div>
            <div class="form-group-siswa">
                <label for="password">Kata Sandi</label>
                <div class="password-container">
                    <input type="password" id="password" name="password" class="form-control-siswa" required placeholder="••••••••">
                    <button type="button" class="toggle-password" onclick="togglePasswordVisibility('password', this)" title="Lihat Password">
                        <svg class="eye-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    </button>
                </div>
            </div>
            <button type="submit" class="btn-siswa">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path><polyline points="10 17 15 12 10 7"></polyline><line x1="15" y1="12" x2="3" y2="12"></line></svg>
                Masuk ke Akun
            </button>
        </form>
        
        <a href="index.php?page=home" class="back-link">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            Kembali ke Halaman Utama
        </a>
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
