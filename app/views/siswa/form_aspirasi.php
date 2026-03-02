<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tulis Aspirasi - Pengaduan Sekolah</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div style="background: white; border-bottom: 1px solid #e5e7eb; position: sticky; top: 0; z-index: 50;">
        <div class="container" style="max-width: 1000px; margin: 0 auto; padding: 16px 24px; display: flex; justify-content: space-between; align-items: center;">
            <a href="index.php?page=siswa_dashboard" style="text-decoration: none; color: var(--text-primary); font-weight: 600; display: flex; align-items: center; gap: 10px; font-size: 14px; padding: 10px 20px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);" onmouseover="this.style.background='white'; this.style.borderColor='var(--accent)'; this.style.color='var(--accent)'; this.style.transform='translateX(-5px)'; this.style.boxShadow='0 12px 20px -5px rgba(59, 130, 246, 0.15)';" onmouseout="this.style.background='#f8fafc'; this.style.borderColor='#e2e8f0'; this.style.color='var(--text-primary)'; this.style.transform='translateX(0)'; this.style.boxShadow='none';">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display: block;"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                <span>Kembali</span>
            </a>
            <div style="font-weight: 800; font-size: 18px; color: var(--text-primary); display: flex; align-items: center; gap: 10px;">
                <div class="logo-box">S</div>
                SchoolVoice
            </div>
        </div>
    </div>

    <div class="container" style="max-width: 700px; margin: 60px auto; padding: 0 24px;">
        <div class="fade-in">
            <header style="margin-bottom: 32px;">
                <h1 style="font-size: 28px; font-weight: 800; color: var(--text-primary); margin-bottom: 8px; letter-spacing: -0.5px;">Buat Laporan</h1>
                <p style="color: var(--text-secondary); font-size: 15px;">Sampaikan aspirasi atau keluhanmu dengan detail agar segera kami tindak lanjuti.</p>
            </header>

            <div class="card-base" style="padding: 40px; border-radius: 16px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05);">
                <form action="index.php?page=store_aspirasi" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="judul">Judul Laporan</label>
                        <input type="text" name="judul" class="form-control" required placeholder="Contoh: Lampu di Ruang Kelas XI RPL Mati">
                        <span style="font-size: 12px; color: var(--text-secondary); margin-top: 8px; display: block; opacity: 0.8;">Gunakan judul yang singkat namun deskriptif.</span>
                    </div>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-top: 24px;">
                        <div class="form-group">
                            <label for="kategori_id">Kategori</label>
                            <select name="kategori_id" class="form-control" required style="appearance: none; background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22none%22%20stroke%3D%22%236b7280%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%3E%3Cpolyline%20points%3D%226%209%2012%2015%2018%209%22%3E%3C%2Fpolyline%3E%3C%2Fsvg%3E'); background-repeat: no-repeat; background-position: right 12px center; background-size: 16px;">
                                <option value="">Pilih Kategori</option>
                                <?php foreach ($kategori_list as $kategori): ?>
                                    <option value="<?php echo $kategori['id']; ?>"><?php echo $kategori['nama_kategori']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="lokasi">Lokasi Kejadian</label>
                            <input type="text" name="lokasi" class="form-control" placeholder="Contoh: Gedung C Lt 3">
                        </div>
                    </div>

                    <div class="form-group" style="margin-top: 24px;">
                        <label for="deskripsi">Deskripsi Masalah</label>
                        <textarea name="deskripsi" class="form-control" rows="6" required placeholder="Jelaskan secara mendalam mengenai masalah yang kamu temukan..." style="resize: none;"></textarea>
                    </div>

                    <div class="form-group" style="margin-top: 24px;">
                        <label for="foto" style="font-size: 14px; font-weight: 600; margin-bottom: 10px; display: block;">Foto Bukti (Opsional)</label>
                        <div id="drop-area" style="border: 2px dashed #d1d5db; padding: 40px 20px; text-align: center; border-radius: 12px; cursor: pointer; transition: all 0.2s; background: #f9fafb;" onclick="document.getElementById('foto').click()" onmouseover="this.style.borderColor='var(--accent)'; this.style.background='#eff6ff'" onmouseout="this.style.borderColor='#d1d5db'; this.style.background='#f9fafb'">
                            <span style="font-size: 32px; display: block; margin-bottom: 12px;">📸</span>
                            <span style="color: var(--text-primary); font-weight: 600; display: block; margin-bottom: 4px;">Klik untuk unggah foto</span>
                            <span style="color: var(--text-secondary); font-size: 12px;">Maksimal 2MB (JPG, PNG)</span>
                            <input type="file" id="foto" name="foto" class="form-control" accept="image/*" style="display: none;" onchange="updateFileName(this)">
                            <div id="file-name" style="margin-top: 12px; font-size: 13px; color: var(--accent); font-weight: 600; display: none;"></div>
                        </div>
                    </div>

                    <div style="margin-top: 40px;">
                        <button type="submit" class="btn btn-primary" style="width: 100%; padding: 16px; justify-content: center; font-size: 16px; font-weight: 700; border-radius: 12px; box-shadow: 0 4px 12px rgba(30, 41, 59, 0.2); transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                            🚀 Kirim Laporan Sekarang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function updateFileName(input) {
            const fileNameDiv = document.getElementById('file-name');
            if (input.files && input.files[0]) {
                fileNameDiv.textContent = '📎 ' + input.files[0].name;
                fileNameDiv.style.display = 'block';
                document.getElementById('drop-area').style.borderColor = 'var(--success)';
                document.getElementById('drop-area').style.background = '#f0fdf4';
            }
        }
    </script>
</body>
</html>
