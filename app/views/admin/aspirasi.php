<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Aspirasi - Admin</title>
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
                <a href="index.php?page=admin_aspirasi" class="active">
                    <span>📁</span> Data Aspirasi
                </a>
                <a href="index.php?page=admin_users">
                    <span>👥</span> Data Pengguna
                </a>
                <a href="index.php?page=admin_settings">
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
                    <h1>Data Aspirasi</h1>
                    <p>Daftar lengkap laporan yang masuk.</p>
                </div>
            </header>
            
            <!-- Filter Section -->
            <div class="card-base fade-in" style="margin-bottom: 24px; padding: 24px;">
                <form action="index.php" method="GET" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px; align-items: flex-end;">
                    <input type="hidden" name="page" value="admin_aspirasi">
                    
                    <div class="form-group" style="margin-bottom: 0;">
                        <label style="font-size: 12px; text-transform: uppercase; color: var(--text-secondary);">Kategori</label>
                        <select name="category" class="form-control">
                            <option value="">Semua Kategori</option>
                            <?php foreach($categories as $cat): ?>
                                <option value="<?php echo $cat['id']; ?>" <?php echo (isset($_GET['category']) && $_GET['category'] == $cat['id']) ? 'selected' : ''; ?>>
                                    <?php echo $cat['nama_kategori']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group" style="margin-bottom: 0;">
                        <label style="font-size: 12px; text-transform: uppercase; color: var(--text-secondary);">Tanggal</label>
                        <input type="date" name="date" class="form-control" value="<?php echo isset($_GET['date']) ? $_GET['date'] : ''; ?>">
                    </div>

                    <div class="form-group" style="margin-bottom: 0;">
                        <label style="font-size: 12px; text-transform: uppercase; color: var(--text-secondary);">Bulan</label>
                        <select name="month" class="form-control">
                            <option value="">Semua Bulan</option>
                            <?php
                            $months = [
                                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                            ];
                            foreach($months as $num => $name): ?>
                                <option value="<?php echo $num; ?>" <?php echo (isset($_GET['month']) && $_GET['month'] == $num) ? 'selected' : ''; ?>>
                                    <?php echo $name; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group" style="margin-bottom: 0;">
                        <label style="font-size: 12px; text-transform: uppercase; color: var(--text-secondary);">Tahun</label>
                        <select name="year" class="form-control">
                            <option value="">Semua Tahun</option>
                            <?php 
                            $currentYear = date('Y');
                            for($i = $currentYear; $i >= $currentYear - 5; $i--): ?>
                                <option value="<?php echo $i; ?>" <?php echo (isset($_GET['year']) && $_GET['year'] == $i) ? 'selected' : ''; ?>>
                                    <?php echo $i; ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <div style="display: flex; gap: 8px;">
                        <button type="submit" class="btn btn-primary" style="padding: 12px 16px; flex: 1;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                            Filter
                        </button>
                        <a href="index.php?page=admin_aspirasi" class="btn btn-secondary" style="padding: 12px 16px; flex: 1;">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <div class="card-base fade-in">
                <div style="overflow-x: auto;">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tanggal</th>
                                <th>Pelapor</th>
                                <th>Kategori</th>
                                <th style="width: 30%;">Laporan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($aspirasi_list)): ?>
                            <tr>
                                <td colspan="7" style="text-align: center; padding: 60px 20px; color: var(--text-secondary);">
                                    <div style="font-size: 48px; margin-bottom: 16px; opacity: 0.5;">🔍</div>
                                    <div style="font-weight: 700; font-size: 18px; color: var(--text-primary); margin-bottom: 8px;">Data Tidak Ditemukan</div>
                                    <p style="font-size: 14px; max-width: 300px; margin: 0 auto; line-height: 1.6;">Tidak ada aspirasi yang sesuai dengan kriteria filter Anda. Silakan coba filter lain atau atur ulang pencarian.</p>
                                    <a href="index.php?page=admin_aspirasi" style="display: inline-block; margin-top: 24px; color: var(--accent); font-weight: 700; text-decoration: none; font-size: 14px; padding: 8px 16px; background: #eff6ff; border-radius: 8px;">Atur Ulang Semua Filter</a>
                                </td>
                            </tr>
                            <?php else: ?>
                            <?php foreach ($aspirasi_list as $row): ?>
                            <tr>
                                <td>#<?php echo $row['id']; ?></td>
                                <td><?php echo date('d/m/Y', strtotime($row['tanggal'])); ?></td>
                                <td><?php echo $row['nama_pelapor']; ?></td>
                                <td><?php echo $row['nama_kategori']; ?></td>
                                <td>
                                    <div style="font-weight: 600;"><?php echo $row['judul']; ?></div>
                                    <div style="font-size: 13px; color: var(--text-secondary);"><?php echo $row['deskripsi']; ?></div>
                                    <?php if($row['fotobukti']): ?>
                                        <a href="public/uploads/<?php echo $row['fotobukti']; ?>" target="_blank" style="text-decoration: none; color: var(--accent); font-weight: 600; font-size: 12px; display: inline-flex; align-items: center; gap: 4px; padding: 4px 8px; background: #eff6ff; border-radius: 6px; transition: all 0.2s;" onmouseover="this.style.background='var(--accent)'; this.style.color='white';" onmouseout="this.style.background='#eff6ff'; this.style.color='var(--accent)';">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                                            Lihat Foto
                                        </a>
                                    <?php endif; ?>
                                    <?php if(!empty($row['feedback_pesan'])): ?>
                                        <span style="font-size: 12px; color: var(--success); display: inline-flex; align-items: center; gap: 4px;">
                                            <span>💬</span> Balasan terkirim
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge badge-<?php echo $row['status']; ?>">
                                        <?php echo ucfirst($row['status']); ?>
                                    </span>
                                </td>
                                <td>
                                    <div style="display: flex; gap: 8px;">
                                        <button onclick="openModal(<?php echo $row['id']; ?>, '<?php echo $row['status']; ?>')" style="padding: 8px 12px; background: #eff6ff; color: var(--accent); border: 1px solid #dbeafe; border-radius: 10px; font-size: 11px; font-weight: 700; cursor: pointer; transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 6px;" onmouseover="this.style.background='var(--accent)'; this.style.color='white'; this.style.transform='translateY(-2px)';" onmouseout="this.style.background='#eff6ff'; this.style.color='var(--accent)'; this.style.transform='translateY(0)';">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                                            Tindak Lanjut
                                        </button>
                                        <a href="index.php?page=delete_aspirasi&id=<?php echo $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus laporan ini? Seluruh feedback terkait juga akan terhapus.')" style="padding: 8px 12px; background: #fef2f2; color: #ef4444; border: 1px solid #fee2e2; border-radius: 10px; font-size: 11px; font-weight: 700; cursor: pointer; transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 6px; text-decoration: none;" onmouseover="this.style.background='#ef4444'; this.style.color='white'; this.style.transform='translateY(-2px)';" onmouseout="this.style.background='#fef2f2'; this.style.color='#ef4444'; this.style.transform='translateY(0)';">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                            Hapus
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
        </main>
    </div>

    <!-- Modal Update Status -->
    <div id="feedbackModal" class="modal-overlay">
        <div class="modal-content fade-in">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                <h3 style="font-size: 18px; font-weight: 700;">Update Status Laporan</h3>
                <span style="font-size: 24px; cursor: pointer; color: #9ca3af;" onclick="closeModal()">&times;</span>
            </div>
            
            <form action="index.php?page=update_status" method="POST">
                <input type="hidden" name="aspirasi_id" id="modal_aspirasi_id">
                
                <div class="form-group">
                    <label>Status Laporan</label>
                    <select name="status" id="modal_status" class="form-control">
                        <option value="pending">Pending (Menunggu)</option>
                        <option value="proses">Sedang Diproses</option>
                        <option value="selesai">Selesai Dikerjakan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Feedback / Balasan Admin</label>
                    <textarea name="feedback" class="form-control" rows="4" placeholder="Tuliskan tindakan yang telah diambil atau pesan untuk siswa..."></textarea>
                </div>

                <div style="display: flex; gap: 12px; justify-content: flex-end; margin-top: 32px;">
                    <button type="button" onclick="closeModal()" style="padding: 10px 20px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; font-weight: 600; color: var(--text-secondary); cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#f1f5f9'; this.style.color='var(--text-primary)';" onmouseout="this.style.background='#f8fafc'; this.style.color='var(--text-secondary)';">Batal</button>
                    <button type="submit" style="padding: 10px 24px; background: var(--sidebar-bg); border: none; border-radius: 10px; font-weight: 700; color: white; cursor: pointer; transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 8px;" onmouseover="this.style.background='#334155'; this.style.transform='translateY(-2px)';" onmouseout="this.style.background='var(--sidebar-bg)'; this.style.transform='translateY(0)';">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                        Simpan Perubahan
                    </button>
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
        window.onclick = function(e) {
            if (e.target == modal) closeModal();
        }
    </script>
</body>
</html>
