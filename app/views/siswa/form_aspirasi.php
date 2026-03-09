<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Laporan Baru - SchoolVoice</title>
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
            max-width: 1000px; margin: 0 auto;
            padding: 16px 24px;
            display: flex; justify-content: space-between; align-items: center;
        }
        .btn-back {
            text-decoration: none; color: #0f172a; font-weight: 600;
            display: inline-flex; align-items: center; gap: 8px;
            font-size: 13px; padding: 9px 18px;
            background: #f1f5f9; border: 1px solid #e2e8f0; border-radius: 10px;
            transition: all 0.2s ease;
        }
        .btn-back:hover {
            background: #fff; border-color: #3b82f6; color: #3b82f6;
            transform: translateX(-3px);
        }
        .logo {
            font-weight: 800; font-size: 18px; color: #0f172a;
            display: flex; align-items: center; gap: 10px;
        }
        .logo-box {
            background: #3b82f6; color: white;
            width: 34px; height: 34px; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; font-weight: 800;
        }

        /* Main */
        .main-wrap { max-width: 680px; margin: 48px auto; padding: 0 24px 80px; }

        .page-header { margin-bottom: 28px; }
        .page-header h1 { font-size: 30px; font-weight: 800; color: #0f172a; letter-spacing: -0.8px; margin-bottom: 6px; }
        .page-header p { color: #64748b; font-size: 14px; }

        /* Card */
        .form-card {
            background: #ffffff;
            border-radius: 20px;
            border: 1px solid #e8eef5;
            box-shadow: 0 4px 24px rgba(0,0,0,0.06);
            padding: 36px;
        }

        /* Form elements */
        .form-group { margin-bottom: 22px; }
        .form-group label {
            display: block; margin-bottom: 7px;
            font-weight: 600; font-size: 13px; color: #374151; letter-spacing: 0.1px;
        }
        .form-hint { font-size: 12px; color: #94a3b8; margin-top: 6px; display: block; }

        .form-input {
            width: 100%; padding: 11px 14px;
            background: #ffffff; border: 1.5px solid #e2e8f0;
            border-radius: 10px; font-size: 14px; color: #0f172a;
            transition: border-color 0.2s, box-shadow 0.2s;
            font-family: inherit;
        }
        .form-input:focus {
            outline: none; border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.12);
        }
        .form-input::placeholder { color: #94a3b8; }

        textarea.form-input { resize: none; }

        select.form-input {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' width%3D'16' height%3D'16' viewBox%3D'0 0 24 24' fill%3D'none' stroke%3D'%236b7280' stroke-width%3D'2' stroke-linecap%3D'round' stroke-linejoin%3D'round'%3E%3Cpolyline points%3D'6 9 12 15 18 9'%3E%3C%2Fpolyline%3E%3C%2Fsvg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 36px;
        }

        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }

        /* Drop zone */
        .drop-zone {
            border: 2px dashed #cbd5e1; padding: 36px 20px;
            text-align: center; border-radius: 12px;
            cursor: pointer; transition: all 0.2s;
            background: #f8fafc;
        }
        .drop-zone:hover { border-color: #3b82f6; background: #eff6ff; }
        .drop-zone .icon { font-size: 30px; display: block; margin-bottom: 10px; }
        .drop-zone .label { color: #0f172a; font-weight: 600; font-size: 14px; display: block; margin-bottom: 4px; }
        .drop-zone .sub { color: #64748b; font-size: 12px; }
        #file-name { margin-top: 10px; font-size: 13px; color: #3b82f6; font-weight: 600; display: none; }

        /* Submit button */
        .btn-submit {
            width: 100%; padding: 15px;
            background: #3b82f6; color: white;
            border: none; border-radius: 12px;
            font-size: 15px; font-weight: 700;
            cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px;
            transition: all 0.25s ease;
            box-shadow: 0 4px 14px rgba(59,130,246,0.3);
            font-family: inherit;
        }
        .btn-submit:hover {
            background: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(59,130,246,0.4);
        }
        .btn-submit:active { transform: translateY(0); }

        .divider { height: 1px; background: #f1f5f9; margin: 28px 0; }

        @keyframes fadeIn { from { opacity:0; transform: translateY(10px); } to { opacity:1; transform: translateY(0); } }
        .fade-in { animation: fadeIn 0.35s ease-out forwards; }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="navbar-inner">
            <a href="index.php?page=siswa_dashboard" class="btn-back">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                Kembali
            </a>
            <div class="logo">
                <div class="logo-box">S</div>
                SchoolVoice
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-wrap fade-in">
        <div class="page-header">
            <h1>Buat Laporan</h1>
            <p>Sampaikan keluhanmu dengan detail agar segera kami tindak lanjuti.</p>
        </div>

        <div class="form-card">
            <form action="index.php?page=store_aspirasi" method="POST" enctype="multipart/form-data">

                <!-- Judul -->
                <div class="form-group">
                    <label for="judul">Judul Laporan</label>
                    <input type="text" id="judul" name="judul" class="form-input" required placeholder="Contoh: Lampu di Ruang Kelas XI RPL Mati">
                    <span class="form-hint">Gunakan judul yang singkat namun deskriptif.</span>
                </div>

                <!-- Kategori & Lokasi -->
                <div class="grid-2">
                    <div class="form-group">
                        <label for="kategori_id">Kategori</label>
                        <select id="kategori_id" name="kategori_id" class="form-input" required>
                            <option value="">Pilih Kategori</option>
                            <?php foreach ($kategori_list as $kategori): ?>
                                <option value="<?php echo $kategori['id']; ?>"><?php echo $kategori['nama_kategori']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="lokasi">Lokasi Kejadian</label>
                        <input type="text" id="lokasi" name="lokasi" class="form-input" placeholder="Contoh: Gedung C Lt 3">
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="form-group">
                    <label for="deskripsi">Deskripsi Masalah</label>
                    <textarea id="deskripsi" name="deskripsi" class="form-input" rows="5" required placeholder="Jelaskan secara mendalam mengenai masalah yang kamu temukan..."></textarea>
                </div>

                <div class="divider"></div>

                <!-- Foto Bukti -->
                <div class="form-group" style="margin-bottom: 0;">
                    <label for="foto">Foto Bukti <span style="font-weight: 400; color: #94a3b8;">(Opsional)</span></label>
                    <div class="drop-zone" id="drop-area" onclick="document.getElementById('foto').click()">
                        <span class="icon">📸</span>
                        <span class="label">Klik untuk unggah foto</span>
                        <span class="sub">Maksimal 2MB (JPG, PNG)</span>
                        <input type="file" id="foto" name="foto" accept="image/*" style="display: none;" onchange="updateFileName(this)">
                        <div id="file-name"></div>
                    </div>
                </div>

                <!-- Submit -->
                <div style="margin-top: 28px;">
                    <button type="submit" class="btn-submit">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                        Kirim Laporan Sekarang
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script>
        function updateFileName(input) {
            const fileNameDiv = document.getElementById('file-name');
            const dropArea = document.getElementById('drop-area');
            if (input.files && input.files[0]) {
                fileNameDiv.textContent = '📎 ' + input.files[0].name;
                fileNameDiv.style.display = 'block';
                dropArea.style.borderColor = '#10b981';
                dropArea.style.background = '#f0fdf4';
            }
        }
    </script>
</body>
</html>
