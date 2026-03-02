<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SchoolVoice - Sistem Aspirasi & Pengaduan Sekolah</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        html {
            scroll-behavior: smooth;
        }

        :root {
            --home-bg: #ffffff;
            --home-text: #0f172a;
            --home-muted: #64748b;
            --home-accent: #3b82f6;
            --max-width: 1100px;
        }

        .hero-section {
            min-height: 85vh;
            display: flex;
            align-items: center;
            background-color: var(--home-bg);
            padding: 0 24px;
            position: relative;
            overflow: hidden;
            border-bottom: 1px solid #f1f5f9;
        }

        /* ... existing styles ... */

        .btn-large:active {
            transform: scale(0.95);
        }

        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease-out;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        .feature-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1) !important;
        }

        .container-hero {
            max-width: var(--max-width);
            margin: 0 auto;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
        }

        .hero-content {
            z-index: 10;
            max-width: 600px;
        }

        .hero-title {
            font-size: 52px;
            font-weight: 800;
            line-height: 1.15;
            margin-bottom: 24px;
            letter-spacing: -1.5px;
            color: var(--home-text);
        }

        .hero-subtitle {
            font-size: 18px;
            color: var(--home-muted);
            margin-bottom: 40px;
            line-height: 1.6;
        }

        .cta-buttons {
            display: flex;
            gap: 16px;
        }

        .btn-large {
            padding: 14px 32px;
            font-size: 16px;
            font-weight: 700;
            border-radius: 12px;
            transition: all 0.2s ease;
        }

        .btn-outline {
            background: white;
            color: var(--home-text);
            border: 1px solid #e2e8f0;
        }

        .btn-outline:hover {
            background: #f8fafc;
            transform: translateY(-2px);
        }

        .hero-decoration {
            width: 450px;
            height: 450px;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(30, 41, 59, 0.05) 100%);
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            position: absolute;
            right: -50px;
            z-index: 1;
        }

        .nav-home {
            position: sticky;
            top: 0;
            width: 100%;
            z-index: 100;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid #f1f5f9;
        }

        .nav-container {
            max-width: var(--max-width);
            margin: 0 auto;
            padding: 20px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-text {
            font-size: 22px;
            font-weight: 800;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--home-text);
            text-decoration: none;
        }

        .logo-box {
            background: #1e293b;
            color: white;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .stat-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #eff6ff;
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            color: var(--home-accent);
            margin-bottom: 24px;
            border: 1px solid #dbeafe;
        }

        @media (max-width: 768px) {
            .hero-title { font-size: 38px; }
            .hero-decoration { display: none; }
            .cta-buttons { flex-direction: column; }
            .container-hero { justify-content: center; text-align: center; }
            .hero-content { max-width: 100%; }
        }
    </style>
</head>
<body>
    <nav class="nav-home">
        <div class="nav-container">
            <a href="index.php" class="logo-text">
                <div class="logo-box">S</div>
                SchoolVoice
            </a>
            <div style="display: flex; gap: 12px; align-items: center;">
                <a href="index.php?page=login_siswa" style="text-decoration: none; color: white; font-weight: 600; font-size: 14px; padding: 10px 20px; background: #1e293b; border-radius: 12px; transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 8px;" onmouseover="this.style.background='#334155'; this.style.transform='translateY(-2px)';" onmouseout="this.style.background='#1e293b'; this.style.transform='translateY(0)';">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    Masuk Siswa
                </a>
                <a href="index.php?page=login_admin" style="text-decoration: none; color: white; font-weight: 600; font-size: 14px; padding: 10px 20px; background: #64748b; border-radius: 12px; transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 8px;" onmouseover="this.style.background='#475569'; this.style.transform='translateY(-2px)';" onmouseout="this.style.background='#64748b'; this.style.transform='translateY(0)';">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                    Admin
                </a>
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <div class="container-hero">
            <div class="hero-content fade-in">
                <div class="stat-badge">
                    <span>⭐</span> Platform Aspirasi Digital Siswa
                </div>
                <h1 class="hero-title">Satu Wadah untuk <span style="color: var(--home-accent);">Suara Siswa</span> Berkontribusi.</h1>
                <p class="hero-subtitle">SchoolVoice adalah platform digital yang menjembatani komunikasi antara siswa dan pihak sekolah untuk menciptakan lingkungan belajar yang lebih baik melalui aspirasi yang transparan.</p>
                
                <div class="cta-buttons">
                    <a href="#features" style="text-decoration: none; color: white; background: #3b82f6; font-weight: 700; padding: 18px 36px; border-radius: 16px; display: inline-flex; align-items: center; gap: 12px; transition: all 0.3s ease; box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.2);" onmouseover="this.style.transform='translateY(-4px)'; this.style.background='#2563eb'; this.style.boxShadow='0 20px 25px -5px rgba(37, 99, 235, 0.3)';" onmouseout="this.style.transform='translateY(0)'; this.style.background='#3b82f6'; this.style.boxShadow='0 10px 15px -3px rgba(37, 99, 235, 0.2)';">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                        Lihat Manfaat & Penjelasan
                    </a>
                    <a href="index.php?page=register" style="text-decoration: none; color: var(--home-text); background: white; border: 1px solid #e2e8f0; font-weight: 700; padding: 18px 36px; border-radius: 16px; display: inline-flex; align-items: center; gap: 12px; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-4px)'; this.style.background='#f8fafc'; this.style.borderColor='var(--home-accent)';" onmouseout="this.style.transform='translateY(0)'; this.style.background='white'; this.style.borderColor='#e2e8f0';">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                        Daftar Anggota Baru
                    </a>
                </div>
            </div>
            <div class="hero-decoration"></div>
        </div>
    </section>

    <section id="features" style="padding: 100px 5%; background: #ffffff;">
        <div style="max-width: var(--max-width); margin: 0 auto;">
            <div class="reveal" style="text-align: center; max-width: 800px; margin: 0 auto 80px;">
                <h2 style="font-size: 36px; font-weight: 800; margin-bottom: 24px; color: var(--home-text); letter-spacing: -1px;">Apa itu SchoolVoice?</h2>
                <p style="color: var(--home-muted); font-size: 18px; line-height: 1.6;">SchoolVoice adalah sistem manajemen aspirasi digital yang dirancang khusus untuk lingkungan sekolah. Kami percaya bahwa setiap suara siswa sangat berharga untuk menciptakan perubahan positif di sekolah.</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 40px;">
                <div class="card-base feature-card reveal" style="border: 1px solid #f1f5f9; background: #ffffff; padding: 48px; border-radius: 24px; transition: all 0.3s; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                    <div style="font-size: 48px; margin-bottom: 24px;">🎯</div>
                    <h3 style="font-size: 22px; font-weight: 700; margin-bottom: 16px; color: var(--home-text);">Fokus pada Solusi</h3>
                    <p style="color: var(--home-muted); font-size: 15px; line-height: 1.7;">Membantu pihak sekolah mengidentifikasi masalah fasilitas atau kebijakan dengan lebih cepat berdasarkan data riil dari siswa di lapangan.</p>
                </div>
                <div class="card-base feature-card reveal" style="border: 1px solid #f1f5f9; background: #ffffff; padding: 48px; border-radius: 24px; transition: all 0.3s; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                    <div style="font-size: 48px; margin-bottom: 24px;">📊</div>
                    <h3 style="font-size: 22px; font-weight: 700; margin-bottom: 16px; color: var(--home-text);">Transparansi Proses</h3>
                    <p style="color: var(--home-muted); font-size: 15px; line-height: 1.7;">Siswa dapat memantau apakah aspirasi mereka sedang diproses, sudah selesai, atau ditolak, lengkap dengan umpan balik langsung dari admin.</p>
                </div>
                <div class="card-base feature-card reveal" style="border: 1px solid #f1f5f9; background: #ffffff; padding: 48px; border-radius: 24px; transition: all 0.3s; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                    <div style="font-size: 48px; margin-bottom: 24px;">🤝</div>
                    <h3 style="font-size: 22px; font-weight: 700; margin-bottom: 16px; color: var(--home-text);">Kolaborasi Efektif</h3>
                    <p style="color: var(--home-muted); font-size: 15px; line-height: 1.7;">Membangun kepercayaan antara siswa dan sekolah melalui komunikasi dua arah yang tercatat dan terorganisir dengan baik.</p>
                </div>
            </div>

            <div class="reveal" style="margin-top: 80px; padding: 60px; background: #f8fafc; border-radius: 32px; text-align: center;">
                <h3 style="font-size: 24px; font-weight: 800; color: var(--home-text); mb-16;">Siap Berkontribusi Sekarang?</h3>
                <p style="color: var(--home-muted); margin: 16px auto 32px; max-width: 600px;">Jadilah bagian dari perubahan sekolahmu hari ini dengan mulai menyampaikan aspirasi pertamamu.</p>

            </div>
        </div>
    </section>

    <footer style="padding: 60px 24px; background: #f8fafc; color: var(--home-muted); text-align: center; font-size: 14px; border-top: 1px solid #f1f5f9;">
        <div style="max-width: var(--max-width); margin: 0 auto;">
            <div class="logo-text" style="justify-content: center; margin-bottom: 24px; opacity: 0.6;">
                <div class="logo-box">S</div>
                SchoolVoice
            </div>
            <p>&copy; 2026 SchoolVoice. Hak Cipta Dilindungi.</p>
        </div>
    </footer>

    <script>
        // Reveal animation on scroll
        const observerOptions = {
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        // Subtle click effect for CTA
        document.querySelector('a[href="#features"]').addEventListener('click', function(e) {
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
    </script>
</body>
</html>
</body>
</html>
