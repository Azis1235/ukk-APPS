<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - SchoolVoice</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Inter', sans-serif; }
        body { background-color: #f8fafc; color: #0f172a; line-height: 1.5; font-size: 14px; }

        /* Navbar */
        .navbar {
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(226,232,240,0.8);
            position: sticky; top: 0; z-index: 50;
        }
        .navbar-inner {
            max-width: 860px; margin: 0 auto;
            padding: 16px 24px;
            display: flex; justify-content: space-between; align-items: center;
        }
        .logo {
            font-weight: 700; font-size: 18px; color: #0f172a;
            display: flex; align-items: center; gap: 8px;
        }
        .logo-box {
            background: #3b82f6; color: white;
            width: 32px; height: 32px; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-weight: 800; font-size: 15px;
        }
        .nav-right { display: flex; align-items: center; gap: 12px; }
        .nav-hello { font-size: 14px; font-weight: 500; color: #64748b; }
        .btn-logout {
            text-decoration: none; color: #ef4444; font-weight: 600;
            display: inline-flex; align-items: center; gap: 7px;
            font-size: 13px; padding: 8px 16px;
            background: #fef2f2; border: 1px solid #fee2e2; border-radius: 10px;
            transition: all 0.25s ease;
        }
        .btn-logout:hover {
            background: #ef4444; color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239,68,68,0.25);
        }

        /* Main */
        .main-wrap { max-width: 860px; margin: 0 auto; padding: 40px 24px 80px; }

        /* Page Header */
        .page-header { text-align: center; margin-bottom: 36px; }
        .page-header h1 { font-size: 28px; font-weight: 800; color: #0f172a; margin-bottom: 6px; letter-spacing: -0.5px; }
        .page-header p { color: #64748b; font-size: 14px; }

        /* Empty State */
        .empty-state { text-align: center; padding: 70px 0; }
        .empty-state .icon { font-size: 56px; margin-bottom: 18px; }
        .empty-state h3 { font-size: 20px; font-weight: 700; color: #0f172a; margin-bottom: 10px; }
        .empty-state p { color: #64748b; margin-bottom: 28px; font-size: 14px; }
        .btn-create {
            text-decoration: none; color: white; background: #3b82f6;
            font-weight: 700; padding: 14px 34px;
            border-radius: 12px; display: inline-flex; align-items: center; gap: 10px;
            font-size: 15px; transition: all 0.25s ease;
            box-shadow: 0 6px 20px rgba(59,130,246,0.35);
        }
        .btn-create:hover {
            background: #2563eb;
            transform: translateY(-3px);
            box-shadow: 0 12px 28px rgba(59,130,246,0.45);
        }

        /* Timeline */
        .timeline { display: flex; flex-direction: column; gap: 20px; }

        /* Card */
        .report-card {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #e8eef5;
            box-shadow: 0 2px 12px rgba(0,0,0,0.05);
            padding: 24px;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }
        .report-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 24px rgba(0,0,0,0.09);
        }

        /* Card top row: badge + date */
        .card-top {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 14px;
        }
        .badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 5px 12px; border-radius: 50px;
            font-size: 12px; font-weight: 700;
        }
        .badge-pending  { background: #fef3c7; color: #d97706; }
        .badge-proses   { background: #e0f2fe; color: #0284c7; }
        .badge-selesai  { background: #d1fae5; color: #059669; }
        .badge-ditolak  { background: #fee2e2; color: #ef4444; }
        .card-date { font-size: 12px; color: #94a3b8; font-weight: 500; }

        /* Card body */
        .card-title { font-size: 17px; font-weight: 700; color: #0f172a; margin-bottom: 8px; }
        .card-desc  { font-size: 13.5px; color: #64748b; line-height: 1.65; margin-bottom: 0; }

        /* Admin feedback */
        .feedback-box {
            background: #f0f7ff;
            border-left: 3px solid #3b82f6;
            padding: 14px 16px;
            border-radius: 0 10px 10px 0;
            margin-top: 16px;
        }
        .feedback-label { font-size: 11px; font-weight: 700; color: #3b82f6; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; }
        .feedback-text  { font-size: 13.5px; color: #0f172a; line-height: 1.55; }
        .feedback-date  { font-size: 11px; color: #94a3b8; margin-top: 8px; text-align: right; }

        /* Card footer */
        .card-footer {
            display: flex; align-items: center; gap: 12px;
            padding-top: 14px; border-top: 1px solid #f1f5f9;
            margin-top: 16px;
        }
        .card-category { display: flex; align-items: center; gap: 6px; font-size: 13px; color: #64748b; }
        .btn-photo {
            margin-left: auto; text-decoration: none; color: #3b82f6;
            font-weight: 600; display: inline-flex; align-items: center; gap: 6px;
            font-size: 12px; padding: 5px 12px;
            background: #eff6ff; border-radius: 8px; transition: all 0.2s ease;
        }
        .btn-photo:hover { background: #3b82f6; color: white; }

        @keyframes fadeIn { from { opacity:0; transform:translateY(10px); } to { opacity:1; transform:translateY(0); } }
        .fade-in { animation: fadeIn 0.4s ease-out forwards; }

        /* Modal View Image */
        .modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.4); backdrop-filter: blur(4px); z-index: 100; align-items: center; justify-content: center; }
        .modal-content { background: white; width: 100%; max-width: 600px; border-radius: 24px; padding: 12px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); position: relative; }
        .modal-close { position: absolute; top: 12px; right: 20px; font-size: 32px; color: #94a3b8; cursor: pointer; z-index: 10; transition: color 0.2s; }
        .modal-close:hover { color: #0f172a; }
        #previewImage { width: 100%; border-radius: 16px; display: block; }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <div class="navbar-inner">
            <div class="logo">
                <div class="logo-box">S</div>
                SchoolVoice
            </div>
            <div class="nav-right">
                <span class="nav-hello">Halo, <?php echo $_SESSION['nama_lengkap']; ?></span>
                <a href="index.php?page=logout" class="btn-logout">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                    Logout
                </a>
            </div>
        </div>
    </div>

    <!-- Main -->
    <div class="main-wrap fade-in">

        <div class="page-header">
            <h1>Laporan Saya</h1>
            <p>Pantau status pengaduan sarana dan prasarana sekolahmu disini.</p>
        </div>

        <?php if (empty($aspirasi_list)): ?>
            <!-- Empty State -->
            <div class="empty-state">
                <div class="icon">📝</div>
                <h3>Belum ada laporan</h3>
                <p>Kamu belum pernah mengirimkan laporan kerusakan fasilitas.</p>
                <a href="index.php?page=tambah_aspirasi" class="btn-create">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Tambah Aspirasi
                </a>
            </div>

        <?php else: ?>
            <!-- Report List -->
            <div class="timeline">
                <?php foreach ($aspirasi_list as $row): ?>
                <div class="report-card">

                    <!-- Top: Badge + Date -->
                    <div class="card-top">
                        <span class="badge badge-<?php echo $row['status']; ?>">
                            <?php if($row['status'] == 'selesai'): ?>
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <?php elseif($row['status'] == 'proses'): ?>
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                            <?php else: ?>
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                            <?php endif; ?>
                            <?php echo ucfirst($row['status']); ?>
                        </span>
                        <span class="card-date"><?php echo date('d M Y, H:i', strtotime($row['tanggal'])); ?></span>
                    </div>

                    <!-- Title & Description -->
                    <div class="card-title"><?php echo htmlspecialchars($row['judul']); ?></div>
                    <div class="card-desc"><?php echo htmlspecialchars($row['deskripsi']); ?></div>

                    <!-- Admin Feedback -->
                    <?php if (!empty($row['feedback_pesan'])): ?>
                    <div class="feedback-box">
                        <div class="feedback-label">💬 Balasan Admin</div>
                        <div class="feedback-text"><?php echo htmlspecialchars($row['feedback_pesan']); ?></div>
                        <div class="feedback-date">Dibalas pada <?php echo date('d M Y, H:i', strtotime($row['feedback_tanggal'])); ?></div>
                    </div>
                    <?php endif; ?>

                    <!-- Footer: Category + Photo -->
                    <div class="card-footer">
                        <div class="card-category">
                            <span>📂</span>
                            <?php echo htmlspecialchars($row['nama_kategori']); ?>
                        </div>
                        <?php if ($row['fotobukti']): ?>
                        <button type="button" class="btn-photo" onclick="showImage('<?php echo $row['fotobukti']; ?>')">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                            Lihat Foto
                        </button>
                        <?php endif; ?>
                    </div>

                </div>
                <?php endforeach; ?>
            </div>

            <!-- Add More Button -->
            <div style="text-align: center; margin-top: 36px;">
                <a href="index.php?page=tambah_aspirasi" class="btn-create" style="font-size: 14px; padding: 12px 28px;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Tambah Laporan Baru
                </a>
            </div>

        <?php endif; ?>
    </div>

    <!-- Modal View Image -->
    <div id="imageModal" class="modal">
        <div class="modal-content fade-in">
            <span class="modal-close" onclick="closeModal()">&times;</span>
            <img id="previewImage" src="">
        </div>
    </div>

    <script>
        function showImage(src) {
            const modal = document.getElementById('imageModal');
            const img = document.getElementById('previewImage');
            
            // Handle Base64 vs Physical path
            if(src.startsWith('data:')){
                img.src = src;
            } else {
                img.src = 'public/uploads/' + src;
            }
            
            modal.style.display = "flex";
        }

        function closeModal() {
            document.getElementById('imageModal').style.display = "none";
        }

        // Close on click outside
        window.onclick = function(e) {
            const modal = document.getElementById('imageModal');
            if (e.target == modal) closeModal();
        }
    </script>

</body>
</html>
