<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - Pengaduan Sekolah</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div style="background: white; border-bottom: 1px solid #e5e7eb; position: sticky; top: 0; z-index: 50;">
        <div class="container" style="max-width: 1000px; margin: 0 auto; padding: 16px 24px; display: flex; justify-content: space-between; align-items: center;">
            <div style="font-weight: 700; font-size: 18px; color: var(--text-primary); display: flex; align-items: center; gap: 8px;">
                <span style="background: var(--sidebar-bg); color: white; width: 32px; height: 32px; border-radius: 6px; display: flex; align-items: center; justify-content: center;">S</span>
                SchoolVoice
            </div>
            <div style="display: flex; gap: 24px; align-items: center;">
                <span style="font-size: 14px; font-weight: 500;">Halo, <?php echo $_SESSION['nama_lengkap']; ?></span>
                <a href="index.php?page=logout" style="text-decoration: none; color: #ef4444; font-weight: 600; display: flex; align-items: center; gap: 8px; font-size: 13px; padding: 8px 16px; background: #fef2f2; border: 1px solid #fee2e2; border-radius: 10px; transition: all 0.3s ease;" onmouseover="this.style.background='#ef4444'; this.style.color='white'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(239, 68, 68, 0.2)';" onmouseout="this.style.background='#fef2f2'; this.style.color='#ef4444'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                    <span>Logout</span>
                </a>
            </div>
        </div>
    </div>

    <div class="container" style="max-width: 800px; margin: 40px auto; padding: 0 24px; padding-bottom: 80px;">
        <header style="margin-bottom: 40px; text-align: center;">
            <h1 style="font-size: 28px; font-weight: 700; margin-bottom: 8px;">Laporan Saya</h1>
            <p style="color: var(--text-secondary);">Pantau status pengaduan sarana dan prasarana sekolahmu disini.</p>
        </header>

        <div class="timeline-container fade-in">
            <?php if (empty($aspirasi_list)): ?>
                <div style="text-align: center; padding: 60px 0;">
                    <div style="font-size: 48px; margin-bottom: 16px;">📝</div>
                    <h3 style="font-weight: 600; margin-bottom: 8px;">Belum ada laporan</h3>
                    <p style="color: var(--text-secondary); margin-bottom: 24px;">Kamu belum pernah mengirimkan laporan kerusakan fasilitas.</p>
                    <a href="index.php?page=tambah_aspirasi" style="text-decoration: none; color: white; background: var(--sidebar-bg); font-weight: 700; padding: 14px 32px; border-radius: 12px; display: inline-flex; align-items: center; gap: 10px; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(30, 41, 59, 0.2);" onmouseover="this.style.background='#334155'; this.style.transform='translateY(-2px)';" onmouseout="this.style.background='var(--sidebar-bg)'; this.style.transform='translateY(0)';">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        Buat Laporan Sekarang
                    </a>
                </div>
            <?php else: ?>
                <?php foreach ($aspirasi_list as $row): ?>
                    <div class="timeline-item">
                        <div class="timeline-icon">
                            <?php if($row['status'] == 'selesai'): ?>
                                <span style="color: var(--success);">✓</span>
                            <?php elseif($row['status'] == 'proses'): ?>
                                <span style="color: var(--info);">⚙️</span>
                            <?php else: ?>
                                <span style="color: var(--warning);">⏳</span>
                            <?php endif; ?>
                        </div>
                        <div class="timeline-content">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 12px;">
                                <span class="badge badge-<?php echo $row['status']; ?>"><?php echo ucfirst($row['status']); ?></span>
                                <small style="color: var(--text-secondary);"><?php echo date('d M Y, H:i', strtotime($row['tanggal'])); ?></small>
                            </div>
                            
                            <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 8px;"><?php echo $row['judul']; ?></h3>
                            <p style="color: var(--text-secondary); margin-bottom: 16px; font-size: 14px; line-height: 1.6;"><?php echo $row['deskripsi']; ?></p>
                            
                            <?php if(!empty($row['feedback_pesan'])): ?>
                                <div style="background: #f8fafc; border-left: 4px solid var(--accent); padding: 16px; border-radius: 0 8px 8px 0; margin-bottom: 16px;">
                                    <div style="font-weight: 700; font-size: 12px; color: var(--accent); text-transform: uppercase; margin-bottom: 4px;">Balasan Admin</div>
                                    <div style="font-size: 13.5px; color: var(--text-primary); line-height: 1.5;"><?php echo $row['feedback_pesan']; ?></div>
                                    <div style="font-size: 11px; color: var(--text-secondary); margin-top: 8px; text-align: right;">Dibalas pada <?php echo date('d M Y, H:i', strtotime($row['feedback_tanggal'])); ?></div>
                                </div>
                            <?php endif; ?>

                            <div style="display: flex; gap: 16px; padding-top: 16px; border-top: 1px solid #f3f4f6;">
                                <div style="display: flex; align-items: center; gap: 6px; font-size: 13px; color: var(--text-secondary);">
                                    <span>📂</span> <?php echo $row['nama_kategori']; ?>
                                </div>
                                <?php if($row['fotobukti']): ?>
                                    <div style="margin-left: auto;">
                                        <a href="public/uploads/<?php echo $row['fotobukti']; ?>" target="_blank" style="text-decoration: none; color: var(--accent); font-weight: 600; display: flex; align-items: center; gap: 6px; font-size: 13px; padding: 6px 12px; background: #eff6ff; border-radius: 8px; transition: all 0.2s ease;" onmouseover="this.style.background='var(--accent)'; this.style.color='white'; this.style.transform='scale(1.05)';" onmouseout="this.style.background='#eff6ff'; this.style.color='var(--accent)'; this.style.transform='scale(1)';">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                                            Lihat Foto
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <a href="index.php?page=tambah_aspirasi" style="position: fixed; bottom: 32px; right: 32px; background: var(--sidebar-bg); color: white; width: 56px; height: 56px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px; text-decoration: none; box-shadow: var(--shadow); transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
        +
    </a>
</body>
</html>
