<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Aspirasi - SchoolVoice</title>
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
        
        .header-section { margin-bottom: 32px; }
        .header-section h1 { font-size: 32px; font-weight: 800; letter-spacing: -1px; margin-bottom: 8px; }
        .header-section p { color: #64748b; font-size: 16px; }

        /* Card / Filter Section */
        .card { background: white; border-radius: 24px; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); padding: 24px; margin-bottom: 24px; }
        
        form.filter-grid {
            display: flex; flex-wrap: wrap; gap: 16px; align-items: flex-end;
        }
        .filter-item { flex: 1; min-width: 160px; }
        .filter-item label { display: block; font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 8px; }
        
        .form-control { width: 100%; padding: 10px 14px; border: 1.5px solid #e2e8f0; border-radius: 12px; font-size: 13.5px; transition: all 0.2s; }
        .form-control:focus { outline: none; border-color: #3b82f6; box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1); }

        .btn-filter { padding: 11px 20px; background: #3b82f6; color: white; border: none; border-radius: 12px; font-weight: 700; font-size: 13px; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 8px; }
        .btn-filter:hover { background: #2563eb; transform: translateY(-2px); }
        .btn-reset { padding: 11px 20px; background: #f8fafc; color: #64748b; border: 1.5px solid #e2e8f0; border-radius: 12px; font-weight: 700; font-size: 13px; cursor: pointer; text-decoration: none; text-align: center; }
        .btn-reset:hover { background: #f1f5f9; color: #0f172a; }

        /* Table */
        .table-wrap { background: white; border-radius: 24px; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); overflow: hidden; }
        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.1em; padding: 16px 24px; border-bottom: 1px solid #f1f5f9; background: #fafafa; }
        td { padding: 16px 24px; border-bottom: 1px solid #f1f5f9; font-size: 13.5px; vertical-align: top; }
        
        .user-id { font-family: monospace; font-weight: 700; color: #94a3b8; font-size: 12px; }
        .date { font-weight: 600; color: #64748b; font-size: 12px; }
        
        .badge { display: inline-flex; align-items: center; gap: 6px; padding: 4px 12px; border-radius: 50px; font-size: 11px; font-weight: 700; }
        .badge-pending { background: #fef3c7; color: #d97706; }
        .badge-proses { background: #e0f2fe; color: #0284c7; }
        .badge-selesai { background: #d1fae5; color: #059669; }
        .badge-ditolak { background: #fee2e2; color: #ef4444; }

        .btn-img { text-decoration: none; color: #3b82f6; font-weight: 700; font-size: 11px; display: inline-flex; align-items: center; gap: 5px; padding: 4px 10px; background: #eff6ff; border-radius: 8px; margin-top: 8px; transition: all 0.2s; border: none; cursor: pointer; }
        .btn-img:hover { background: #3b82f6; color: white; }

        .btn-respond { text-decoration: none; color: #3b82f6; font-weight: 700; font-size: 12px; display: inline-flex; align-items: center; gap: 6px; padding: 10px 14px; background: #eff6ff; border-radius: 10px; transition: all 0.2s; border: none; cursor: pointer; }
        .btn-respond:hover { background: #3b82f6; color: white; }

        .btn-delete { text-decoration: none; color: #ef4444; font-weight: 700; font-size: 12px; display: inline-flex; align-items: center; gap: 6px; padding: 10px 14px; background: #fef2f2; border-radius: 10px; transition: all 0.2s; }
        .btn-delete:hover { background: #ef4444; color: white; }

        /* Empty state */
        .empty { text-align: center; padding: 80px 20px; }
        .empty .icon { font-size: 48px; margin-bottom: 20px; display: block; opacity: 0.3; }
        .empty h3 { font-size: 20px; font-weight: 800; color: #0f172a; margin-bottom: 8px; }
        .empty p { color: #64748b; font-size: 14px; margin-bottom: 24px; }

        /* Modal */
        .modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.4); backdrop-filter: blur(4px); z-index: 100; align-items: center; justify-content: center; }
        .modal-content { background: white; width: 100%; max-width: 500px; border-radius: 24px; padding: 32px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); }
        .modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
        .modal-footer { display: flex; gap: 12px; margin-top: 32px; }
        .btn-save { flex: 2; padding: 14px; background: #3b82f6; color: white; border: none; border-radius: 12px; font-weight: 700; cursor: pointer; transition: all 0.2s; }
        .btn-cancel { flex: 1; padding: 14px; background: #f1f5f9; color: #64748b; border: none; border-radius: 12px; font-weight: 700; cursor: pointer; }

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
                <a href="index.php?page=admin_aspirasi" class="active">Data Aspirasi</a>
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
            <h1>Data Aspirasi</h1>
            <p>Kelola semua laporan pengaduan siswa secara terstruktur.</p>
        </header>

        <!-- Filter Section -->
        <div class="card">
            <form action="index.php" method="GET" class="filter-grid">
                <input type="hidden" name="page" value="admin_aspirasi">
                
                <div class="filter-item">
                    <label>Kategori</label>
                    <select name="category" class="form-control">
                        <option value="">Semua</option>
                        <?php foreach($categories as $cat): ?>
                            <option value="<?php echo $cat['id']; ?>" <?php echo (isset($_GET['category']) && $_GET['category'] == $cat['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($cat['nama_kategori']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="filter-item">
                    <label>Spesifik Tanggal</label>
                    <input type="date" name="date" class="form-control" value="<?php echo isset($_GET['date']) ? $_GET['date'] : ''; ?>">
                </div>

                <div class="filter-item">
                    <label>Bulan</label>
                    <select name="month" class="form-control">
                        <option value="">Semua</option>
                        <?php
                        $months = [1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu', 9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'];
                        foreach($months as $num => $name): ?>
                            <option value="<?php echo $num; ?>" <?php echo (isset($_GET['month']) && $_GET['month'] == $num) ? 'selected' : ''; ?>>
                                <?php echo $name; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div style="display: flex; gap: 10px; margin-left: 10px;">
                    <button type="submit" class="btn-filter">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        Terapkan
                    </button>
                    <a href="index.php?page=admin_aspirasi" class="btn-reset">Atur Ulang</a>
                </div>
            </form>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Pelapor</th>
                        <th>Kategori</th>
                        <th style="width: 35%;">Isi Laporan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($aspirasi_list)): ?>
                    <tr>
                        <td colspan="5">
                            <div class="empty">
                                <span class="icon">📁</span>
                                <h3>Data Kosong</h3>
                                <p>Tidak ditemukan laporan yang sesuai dengan kriteria filter.</p>
                            </div>
                        </td>
                    </tr>
                    <?php else: ?>
                    <?php foreach ($aspirasi_list as $row): ?>
                    <tr>
                        <td>
                            <div style="font-weight: 700; color: #0f172a;"><?php echo htmlspecialchars($row['nama_pelapor']); ?></div>
                            <div class="date"><?php echo date('d M Y, H:i', strtotime($row['tanggal'])); ?></div>
                            <span class="user-id">#ID-<?php echo $row['id']; ?></span>
                        </td>
                        <td>
                            <div style="font-weight: 600; color: #475569; display: flex; align-items: center; gap: 6px;">
                                <span>📂</span> <?php echo htmlspecialchars($row['nama_kategori']); ?>
                            </div>
                        </td>
                        <td>
                            <div style="font-weight: 700; color: #334155; margin-bottom: 4px;"><?php echo htmlspecialchars($row['judul']); ?></div>
                            <div style="font-size: 13px; color: #64748b; line-height: 1.6;"><?php echo htmlspecialchars($row['deskripsi']); ?></div>
                            
                            <?php if($row['fotobukti']): ?>
                                <button class="btn-img" onclick="showImage('<?php echo $row['fotobukti']; ?>')">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                                    Lampiran Foto
                                </button>
                            <?php endif; ?>
                            
                            <?php if(!empty($row['feedback_pesan'])): ?>
                                <div style="margin-top: 10px; font-size: 11px; color: #10b981; font-weight: 700; display: flex; align-items: center; gap: 4px; background: #ecfdf5; padding: 4px 8px; border-radius: 6px; width: fit-content;">
                                    <span>✓</span> Sudah Ditanggapi
                                </div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="badge badge-<?php echo $row['status']; ?>">
                                <?php echo ucfirst($row['status']); ?>
                            </span>
                        </td>
                        <td>
                            <div style="display: flex; gap: 8px;">
                                <button class="btn-respond" onclick="openModal(<?php echo $row['id']; ?>, '<?php echo $row['status']; ?>')">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                    Respon
                                </button>
                                <a href="index.php?page=delete_aspirasi&id=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('Hapus permanen laporan ini?')">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Form -->
    <div id="respondModal" class="modal">
        <div class="modal-content fade-in">
            <div class="modal-header">
                <h3 style="font-size: 18px; font-weight: 700;">Tanggapan Administrator</h3>
                <span style="font-size: 24px; cursor: pointer; color: #94a3b8;" onclick="closeModal('respondModal')">&times;</span>
            </div>
            <form action="index.php?page=update_status" method="POST">
                <input type="hidden" name="aspirasi_id" id="modal_aspirasi_id">
                <div class="form-group">
                    <label>Progres Pengerjaan</label>
                    <select name="status" id="modal_status" class="form-control">
                        <option value="pending">Pending</option>
                        <option value="proses">Diproses</option>
                        <option value="selesai">Selesai</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Pesan untuk Siswa</label>
                    <textarea name="feedback" class="form-control" rows="5" required placeholder="Tulis tindakan atau alasan status laporan ini..."></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeModal('respondModal')">Batal</button>
                    <button type="submit" class="btn-save">Kirim Tanggapan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal View Image -->
    <div id="imageModal" class="modal">
        <div class="modal-content fade-in" style="max-width: 600px; padding: 12px; position: relative;">
            <span style="position: absolute; top: 12px; right: 20px; font-size: 32px; color: white; cursor: pointer; z-index: 10;" onclick="closeModal('imageModal')">&times;</span>
            <img id="previewImage" src="" style="width: 100%; border-radius: 16px; display: block;">
        </div>
    </div>

    <script>
        function openModal(id, status) {
            document.getElementById('respondModal').style.display = "flex";
            document.getElementById('modal_aspirasi_id').value = id;
            document.getElementById('modal_status').value = status;
        }
        function showImage(src) {
            const modal = document.getElementById('imageModal');
            const img = document.getElementById('previewImage');
            
            // Handle both legacy relative paths and new Base64 data
            if(src.startsWith('data:')){
                img.src = src;
            } else {
                img.src = 'public/uploads/' + src;
            }
            
            modal.style.display = "flex";
        }
        function closeModal(id) { document.getElementById(id).style.display = "none"; }
        window.onclick = function(e) {
            if(e.target.classList.contains('modal')) closeModal(e.target.id);
        }
    </script>
</body>
</html>
