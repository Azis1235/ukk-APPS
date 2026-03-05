<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - School Admin</title>
    <link rel="stylesheet" href="public/css/style.css?v=2">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .simple-stat-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
        }
        .progress-bar-bg {
            flex: 1;
            height: 8px;
            background-color: #f3f4f6;
            border-radius: 4px;
            margin: 0 15px;
            overflow: hidden;
        }
        .progress-bar-fill {
            height: 100%;
            border-radius: 4px;
        }

        body {
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            color: #0f172a;
        }

        .stat-card {
            background: #ffffff;
            border: 1px solid #f1f5f9;
            padding: 32px;
            border-radius: 24px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
        }

        .stat-card::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 150px;
            height: 150px;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.05) 0%, rgba(255, 255, 255, 0) 100%);
            border-radius: 50%;
            transform: translate(30%, -30%);
            pointer-events: none;
        }

        .stat-card:hover {
            transform: translateY(-8px) scale(1.01);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            border-color: #e2e8f0;
        }

        .card-base {
            background: #ffffff;
            border: 1px solid #f1f5f9;
            border-radius: 24px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            padding: 32px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th {
            font-size: 12px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #f1f5f9;
            background: transparent;
            padding: 16px 20px;
            text-align: left;
        }

        table td {
            color: #0f172a;
            padding: 20px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
        }
        
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 10px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
        }
        .badge-pending { background-color: #fef3c7; color: #d97706; }
        .badge-proses { background-color: #e0f2fe; color: #0284c7; }
        .badge-selesai { background-color: #d1fae5; color: #059669; }
    </style>
</head>
<body style="background-color: #f8fafc;">
    <!-- Top Navigation Bar Matching Siswa Dashboard -->
    <div style="background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border-bottom: 1px solid rgba(226, 232, 240, 0.8); position: sticky; top: 0; z-index: 50;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 16px 24px; display: flex; justify-content: space-between; align-items: center;">
            <div style="font-weight: 700; font-size: 18px; color: #0f172a; display: flex; align-items: center; gap: 8px;">
                <span style="background: #3b82f6; color: white; width: 32px; height: 32px; border-radius: 6px; display: flex; align-items: center; justify-content: center;">A</span>
                SchoolVoice
            </div>
            
            <nav style="display: flex; gap: 32px; align-items: center;">
                <a href="index.php?page=admin_dashboard" style="text-decoration: none; color: #3b82f6; font-weight: 600; font-size: 14px;">Dashboard</a>
                <a href="index.php?page=admin_aspirasi" style="text-decoration: none; color: #64748b; font-weight: 500; font-size: 14px; transition: color 0.2s;" onmouseover="this.style.color='#0f172a'" onmouseout="this.style.color='#64748b'">Data Aspirasi</a>
                <a href="index.php?page=admin_users" style="text-decoration: none; color: #64748b; font-weight: 500; font-size: 14px; transition: color 0.2s;" onmouseover="this.style.color='#0f172a'" onmouseout="this.style.color='#64748b'">Data Pengguna</a>
            </nav>

            <div style="display: flex; gap: 24px; align-items: center;">
                <span style="font-size: 14px; font-weight: 500; color: #0f172a;">Administrator</span>
                <a href="index.php?page=logout" style="text-decoration: none; color: #ef4444; font-weight: 600; display: flex; align-items: center; gap: 8px; font-size: 13px; padding: 8px 16px; background: #fef2f2; border: 1px solid #fee2e2; border-radius: 10px; transition: all 0.3s ease;" onmouseover="this.style.background='#ef4444'; this.style.color='white'; this.style.transform='translateY(-2px)';" onmouseout="this.style.background='#fef2f2'; this.style.color='#ef4444'; this.style.transform='translateY(0)';">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                    <span>Logout</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main style="max-width: 1200px; margin: 40px auto; padding: 0 24px; padding-bottom: 80px;">
        <header style="margin-bottom: 40px;">
            <h1 style="font-size: 32px; font-weight: 800; letter-spacing: -1px; color: #0f172a; margin-bottom: 8px;">Dashboard Area</h1>
            <p style="color: #64748b; font-size: 16px; margin: 0;">Ringkasan aktivitas dan seluruh pengaduan laporan sarana sekolah.</p>
        </header>

        <!-- Stats Cards Simplification -->
        <section style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 24px; margin-bottom: 32px;" class="fade-in">
                <div class="stat-card">
                    <div style="font-size: 32px; margin-bottom: 16px;">📁</div>
                    <h3 style="margin-bottom: 8px;">Total Aspirasi</h3>
                    <div class="value"><?php echo $stats['total']; ?></div>
                </div>
                <div class="stat-card" style="border-bottom: 4px solid var(--warning);">
                    <div style="font-size: 32px; margin-bottom: 16px;">⏳</div>
                    <h3 style="margin-bottom: 8px;">Menunggu</h3>
                    <div class="value" style="color: var(--warning);"><?php echo $stats['pending']; ?></div>
                </div>
                <div class="stat-card" style="border-bottom: 4px solid var(--info);">
                    <div style="font-size: 32px; margin-bottom: 16px;">🔄</div>
                    <h3 style="margin-bottom: 8px;">Diproses</h3>
                    <div class="value" style="color: var(--info);"><?php echo $stats['proses']; ?></div>
                </div>
                <div class="stat-card" style="border-bottom: 4px solid var(--success);">
                    <div style="font-size: 32px; margin-bottom: 16px;">✅</div>
                    <h3 style="margin-bottom: 8px;">Selesai</h3>
                    <div class="value" style="color: var(--success);"><?php echo $stats['selesai']; ?></div>
                </div>
            </section>

            <section style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px;" class="fade-in">
                <!-- Recent Aspirations Table -->
                <div class="card-base" style="margin-bottom: 0;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <h3 style="font-weight: 600;">Aspirasi Terbaru</h3>
                        <a href="index.php?page=admin_aspirasi" style="color: var(--accent); text-decoration: none; font-size: 13px;">Lihat Semua</a>
                    </div>
                    
                    <table>
                        <thead>
                            <tr>
                                <th>Kategori</th>
                                <th style="width: 40%;">Laporan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($aspirasi_list as $row): ?>
                            <tr>
                                <td>
                                    <span style="font-weight: 500;"><?php echo $row['nama_kategori']; ?></span><br>
                                    <span style="font-size: 12px; color: var(--text-secondary);"><?php echo date('d M Y', strtotime($row['tanggal'])); ?></span>
                                </td>
                                <td>
                                    <div style="font-weight: 600; margin-bottom: 4px;"><?php echo $row['judul']; ?></div>
                                    <div style="font-size: 13px; color: var(--text-secondary);">Dari: <?php echo $row['nama_pelapor']; ?></div>
                                    <?php if(!empty($row['feedback_pesan'])): ?>
                                        <div style="font-size: 12px; color: var(--success); margin-top: 6px; display: flex; align-items: center; gap: 4px;">
                                            <span>💬</span> Balasan terkirim
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge badge-<?php echo $row['status']; ?>">
                                        <?php echo ucfirst($row['status']); ?>
                                    </span>
                                </td>
                                <td>
                                    <button onclick="openModal(<?php echo $row['id']; ?>, '<?php echo $row['status']; ?>')" style="padding: 8px 16px; background: #eff6ff; color: var(--accent); border: 1px solid #dbeafe; border-radius: 10px; font-size: 12px; font-weight: 700; cursor: pointer; transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 6px;" onmouseover="this.style.background='var(--accent)'; this.style.color='white'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(59, 130, 246, 0.2)';" onmouseout="this.style.background='#eff6ff'; this.style.color='var(--accent)'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                                        Tindak Lanjut
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Simple Stats Distribution (Replaces Chart) -->
                <div class="card-base" style="margin-bottom: 0;">
                    <h3 style="font-weight: 600; margin-bottom: 24px;">Distribusi Status</h3>
                    
                    <?php 
                        $total = $stats['total'] > 0 ? $stats['total'] : 1;
                        $pending_pct = ($stats['pending'] / $total) * 100;
                        $process_pct = ($stats['proses'] / $total) * 100;
                        $done_pct = ($stats['selesai'] / $total) * 100;
                    ?>

                    <div style="margin-top: 10px;">
                        <div class="simple-stat-row">
                            <span style="font-weight: 500; font-size: 13px; width: 80px;">Menunggu</span>
                            <div class="progress-bar-bg">
                                <div class="progress-bar-fill" style="width: <?php echo $pending_pct; ?>%; background-color: var(--warning);"></div>
                            </div>
                            <span style="font-size: 13px; color: var(--text-secondary); width: 30px; text-align: right;"><?php echo $stats['pending']; ?></span>
                        </div>

                        <div class="simple-stat-row">
                            <span style="font-weight: 500; font-size: 13px; width: 80px;">Diproses</span>
                            <div class="progress-bar-bg">
                                <div class="progress-bar-fill" style="width: <?php echo $process_pct; ?>%; background-color: var(--info);"></div>
                            </div>
                            <span style="font-size: 13px; color: var(--text-secondary); width: 30px; text-align: right;"><?php echo $stats['proses']; ?></span>
                        </div>

                        <div class="simple-stat-row">
                            <span style="font-weight: 500; font-size: 13px; width: 80px;">Selesai</span>
                            <div class="progress-bar-bg">
                                <div class="progress-bar-fill" style="width: <?php echo $done_pct; ?>%; background-color: var(--success);"></div>
                            </div>
                            <span style="font-size: 13px; color: var(--text-secondary); width: 30px; text-align: right;"><?php echo $stats['selesai']; ?></span>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </main>

    <!-- Modal remains the same -->
    <div id="feedbackModal" class="modal-overlay">
        <div class="modal-content fade-in">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                <h3 style="font-size: 18px; font-weight: 700;">Update Status Laporan</h3>
                <span style="font-size: 24px; cursor: pointer; color: #9ca3af;" onclick="closeModal()">&times;</span>
            </div>
            
            <form action="index.php?page=update_status" method="POST">
                <input type="hidden" name="aspirasi_id" id="modal_aspirasi_id">
                
                <div class="form-group">
                    <label>Status Saat Ini</label>
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
        // Modal Logic
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
