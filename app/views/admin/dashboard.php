<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SchoolVoice</title>
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
        .container { max-width: 1200px; margin: 40px auto; padding: 0 24px 80px; }
        
        .header-section { margin-bottom: 40px; }
        .header-section h1 { font-size: 32px; font-weight: 800; letter-spacing: -1px; margin-bottom: 8px; }
        .header-section p { color: #64748b; font-size: 16px; }

        /* Stats Grid */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 24px; margin-bottom: 40px; }
        .stat-card {
            background: white; padding: 32px; border-radius: 24px;
            border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative; overflow: hidden;
        }
        .stat-card:hover { transform: translateY(-8px); box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); }
        .stat-card .icon { font-size: 32px; margin-bottom: 16px; display: block; }
        .stat-card .label { font-size: 14px; font-weight: 600; color: #64748b; margin-bottom: 4px; }
        .stat-card .value { font-size: 28px; font-weight: 800; color: #0f172a; }
        
        .stat-card.blue { border-bottom: 4px solid #3b82f6; }
        .stat-card.yellow { border-bottom: 4px solid #f59e0b; }
        .stat-card.indigo { border-bottom: 4px solid #6366f1; }
        .stat-card.emerald { border-bottom: 4px solid #10b981; }

        /* Content Grid */
        .content-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 24px; }
        .card { background: white; border-radius: 24px; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); padding: 32px; }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
        .card-header h3 { font-size: 20px; font-weight: 700; }
        .card-header a { font-size: 13px; font-weight: 600; color: #3b82f6; text-decoration: none; transition: all 0.2s; }
        .card-header a:hover { text-decoration: underline; }

        /* Table */
        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; font-size: 12px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.1em; padding: 12px 16px; border-bottom: 1px solid #f1f5f9; }
        td { padding: 16px; border-bottom: 1px solid #f1f5f9; font-size: 14px; }
        tr:last-child td { border-bottom: none; }
        
        .badge { display: inline-flex; align-items: center; gap: 6px; padding: 4px 12px; border-radius: 50px; font-size: 12px; font-weight: 700; }
        .badge-pending { background: #fef3c7; color: #d97706; }
        .badge-proses { background: #e0f2fe; color: #0284c7; }
        .badge-selesai { background: #d1fae5; color: #059669; }

        .btn-action {
            display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px;
            background: #eff6ff; color: #3b82f6; border: none; border-radius: 10px;
            font-size: 12px; font-weight: 700; cursor: pointer; transition: all 0.2s;
        }
        .btn-action:hover { background: #3b82f6; color: white; transform: translateY(-2px); }

        /* Distribution Progress */
        .dist-row { margin-bottom: 20px; }
        .dist-info { display: flex; justify-content: space-between; font-size: 13px; font-weight: 600; margin-bottom: 8px; }
        .progress-bg { height: 8px; background: #f1f5f9; border-radius: 10px; overflow: hidden; }
        .progress-fill { height: 100%; border-radius: 10px; transition: width 1s ease-in-out; }

        /* Animations */
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .fade-in { animation: fadeIn 0.4s ease-out forwards; }

        /* Modal */
        .modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.4); backdrop-filter: blur(4px); z-index: 100; align-items: center; justify-content: center; }
        .modal-content { background: white; width: 100%; max-width: 500px; border-radius: 24px; padding: 32px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 8px; }
        .form-control { width: 100%; padding: 12px 16px; border: 1.5px solid #e2e8f0; border-radius: 12px; font-size: 14px; transition: all 0.2s; }
        .form-control:focus { outline: none; border-color: #3b82f6; box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1); }
        .btn-save { width: 100%; padding: 14px; background: #3b82f6; color: white; border: none; border-radius: 12px; font-weight: 700; font-size: 15px; cursor: pointer; transition: all 0.2s; margin-top: 12px; }
        .btn-save:hover { background: #2563eb; transform: translateY(-2px); }
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
                <a href="index.php?page=admin_dashboard" class="active">Dashboard</a>
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
            <h1>Dashboard Ringkasan</h1>
            <p>Selamat datang kembali, Administrator. Berikut adalah ikhtisar laporan hari ini.</p>
        </header>

        <section class="stats-grid">
            <div class="stat-card blue">
                <span class="icon">📁</span>
                <div class="label">Total Laporan</div>
                <div class="value"><?php echo $stats['total']; ?></div>
            </div>
            <div class="stat-card yellow">
                <span class="icon">⏳</span>
                <div class="label">Menunggu</div>
                <div class="value"><?php echo $stats['pending']; ?></div>
            </div>
            <div class="stat-card indigo">
                <span class="icon">🔄</span>
                <div class="label">Diproses</div>
                <div class="value"><?php echo $stats['proses']; ?></div>
            </div>
            <div class="stat-card emerald">
                <span class="icon">✅</span>
                <div class="label">Selesai</div>
                <div class="value"><?php echo $stats['selesai']; ?></div>
            </div>
        </section>

        <div class="content-grid">
            <section class="card">
                <div class="card-header">
                    <h3>Laporan Terbaru</h3>
                    <a href="index.php?page=admin_aspirasi">Lihat Semua &rarr;</a>
                </div>
                
                <table>
                    <thead>
                        <tr>
                            <th>Pengadu</th>
                            <th>Judul Laporan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($aspirasi_list as $row): ?>
                        <tr>
                            <td>
                                <div style="font-weight: 700; color: #0f172a;"><?php echo htmlspecialchars($row['nama_pelapor']); ?></div>
                                <div style="font-size: 11px; color: #94a3b8; font-weight: 600;"><?php echo date('d M Y', strtotime($row['tanggal'])); ?></div>
                            </td>
                            <td>
                                <div style="font-weight: 600; color: #334155; margin-bottom: 2px;"><?php echo htmlspecialchars($row['judul']); ?></div>
                                <div style="font-size: 12px; color: #64748b; font-weight: 500;"><?php echo htmlspecialchars($row['nama_kategori']); ?></div>
                            </td>
                            <td>
                                <span class="badge badge-<?php echo $row['status']; ?>">
                                    <?php if($row['status'] == 'selesai'): ?>
                                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    <?php endif; ?>
                                    <?php echo ucfirst($row['status']); ?>
                                </span>
                            </td>
                            <td>
                                <button class="btn-action" onclick="openModal(<?php echo $row['id']; ?>, '<?php echo $row['status']; ?>')">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                                    Respon
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>

            <section class="card">
                <div class="card-header">
                    <h3>Penyebaran Status</h3>
                </div>
                
                <?php 
                    $total_safe = $stats['total'] > 0 ? $stats['total'] : 1;
                    $status_data = [
                        ['label' => 'Menunggu', 'count' => $stats['pending'], 'color' => '#f59e0b'],
                        ['label' => 'Diproses', 'count' => $stats['proses'], 'color' => '#6366f1'],
                        ['label' => 'Selesai', 'count' => $stats['selesai'], 'color' => '#10b981'],
                        ['label' => 'Ditolak', 'count' => $stats['ditolak'] ?? 0, 'color' => '#ef4444']
                    ];
                ?>

                <div style="margin-top: 10px;">
                    <?php foreach ($status_data as $s): 
                        $pct = ($s['count'] / $total_safe) * 100;
                    ?>
                    <div class="dist-row">
                        <div class="dist-info">
                            <span><?php echo $s['label']; ?></span>
                            <span style="color: #94a3b8;"><?php echo $s['count']; ?></span>
                        </div>
                        <div class="progress-bg">
                            <div class="progress-fill" style="width: <?php echo $pct; ?>%; background: <?php echo $s['color']; ?>;"></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div style="margin-top: 40px; padding: 20px; background: #f8fafc; border-radius: 16px; border: 1px solid #f1f5f9;">
                    <div style="font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; margin-bottom: 12px;">Tips Admin</div>
                    <p style="font-size: 13px; color: #475569; line-height: 1.6;">Laporan yang masuk hari ini perlu segera ditinjau untuk menjaga kualitas layanan sekolah.</p>
                </div>
            </section>
        </div>
    </div>

    <!-- Modal Update Status -->
    <div id="feedbackModal" class="modal">
        <div class="modal-content fade-in">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                <h3 style="font-size: 18px; font-weight: 700;">Tindak Lanjut Laporan</h3>
                <span style="font-size: 24px; cursor: pointer; color: #94a3b8;" onclick="closeModal()">&times;</span>
            </div>
            
            <form action="index.php?page=update_status" method="POST">
                <input type="hidden" name="aspirasi_id" id="modal_aspirasi_id">
                
                <div class="form-group">
                    <label>Perbarui Status</label>
                    <select name="status" id="modal_status" class="form-control">
                        <option value="pending">Pending</option>
                        <option value="proses">Diproses</option>
                        <option value="selesai">Selesai</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Pesan Balasan (Siswa akan melihat ini)</label>
                    <textarea name="feedback" class="form-control" rows="4" placeholder="Tulis instruksi atau konfirmasi untuk siswa..." required></textarea>
                </div>

                <div style="display: flex; gap: 12px; margin-top: 32px;">
                    <button type="button" onclick="closeModal()" style="flex: 1; padding: 14px; background: #f1f5f9; color: #64748b; border: none; border-radius: 12px; font-weight: 700; cursor: pointer;">Batal</button>
                    <button type="submit" class="btn-save" style="flex: 2; margin-top: 0;">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById('feedbackModal');
        function openModal(id, status) {
            modal.style.display = "flex";
            document.getElementById('modal_aspirasi_id').value = id;
            document.getElementById('modal_status').value = status;
        }
        function closeModal() {
            modal.style.display = "none";
        }
        window.onclick = function(e) { if (e.target == modal) closeModal(); }
    </script>
</body>
</html>
