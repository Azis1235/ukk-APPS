<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengguna - SchoolVoice</title>
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
        
        .header-section { 
            display: flex; justify-content: space-between; align-items: flex-end;
            margin-bottom: 40px; 
        }
        .header-section h1 { font-size: 32px; font-weight: 800; letter-spacing: -1px; margin-bottom: 8px; }
        .header-section p { color: #64748b; font-size: 16px; }

        .btn-add {
            display: inline-flex; align-items: center; gap: 10px; padding: 12px 24px;
            background: #3b82f6; color: white; border: none; border-radius: 14px;
            font-size: 14px; font-weight: 700; cursor: pointer; transition: all 0.2s;
            box-shadow: 0 6px 16px rgba(59, 130, 246, 0.25);
        }
        .btn-add:hover { background: #2563eb; transform: translateY(-2px); box-shadow: 0 10px 20px rgba(59,130,246,0.3); }

        /* User Card/Table */
        .card { background: white; border-radius: 24px; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); padding: 0; overflow: hidden; }
        
        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; font-size: 12px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.1em; padding: 20px 24px; border-bottom: 1px solid #f1f5f9; background: #fafafa; }
        td { padding: 20px 24px; border-bottom: 1px solid #f1f5f9; font-size: 14px; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #fbfcfd; }

        .user-info { display: flex; align-items: center; gap: 14px; }
        .avatar {
            width: 40px; height: 40px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 16px;
        }
        .avatar.admin { background: #eff6ff; color: #3b82f6; }
        .avatar.siswa { background: #f8fafc; color: #64748b; border: 1.5px solid #e2e8f0; }

        .badge { display: inline-flex; align-items: center; padding: 4px 12px; border-radius: 50px; font-size: 12px; font-weight: 700; }
        .badge-admin { background: #dbeafe; color: #1e40af; }
        .badge-siswa { background: #f1f5f9; color: #475569; }

        .action-btns { display: flex; gap: 10px; }
        .btn-edit {
            text-decoration: none; color: #3b82f6; font-weight: 600; font-size: 13px;
            padding: 8px 14px; background: #eff6ff; border-radius: 10px; transition: all 0.2s;
            display: inline-flex; align-items: center; gap: 6px; border: none; cursor: pointer;
        }
        .btn-edit:hover { background: #3b82f6; color: white; }
        
        .btn-delete {
            text-decoration: none; color: #ef4444; font-weight: 600; font-size: 13px;
            padding: 8px 14px; background: #fef2f2; border-radius: 10px; transition: all 0.2s;
            display: inline-flex; align-items: center; gap: 6px;
        }
        .btn-delete:hover { background: #ef4444; color: white; }

        /* Modal */
        .modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.4); backdrop-filter: blur(4px); z-index: 100; align-items: center; justify-content: center; }
        .modal-content { background: white; width: 100%; max-width: 500px; border-radius: 24px; padding: 32px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 8px; }
        .form-control { width: 100%; padding: 12px 16px; border: 1.5px solid #e2e8f0; border-radius: 12px; font-size: 14px; transition: all 0.2s; }
        .form-control:focus { outline: none; border-color: #3b82f6; box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1); }
        
        .modal-footer { display: flex; gap: 12px; margin-top: 32px; }
        .btn-cancel { flex: 1; padding: 14px; background: #f1f5f9; color: #64748b; border: none; border-radius: 12px; font-weight: 700; cursor: pointer; transition: all 0.2s; }
        .btn-cancel:hover { background: #e2e8f0; }
        .btn-save { flex: 2; padding: 14px; background: #3b82f6; color: white; border: none; border-radius: 12px; font-weight: 700; cursor: pointer; transition: all 0.2s; }
        .btn-save:hover { background: #2563eb; transform: translateY(-2px); }

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
                <a href="index.php?page=admin_aspirasi">Data Aspirasi</a>
                <a href="index.php?page=admin_users" class="active">Data Pengguna</a>
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
            <div>
                <h1>Data Pengguna</h1>
                <p>Kelola otoritas akses sistem melalui manajemen akun siswa dan admin.</p>
            </div>
            <button class="btn-add" onclick="openModal('addModal')">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Tambah Pengguna
            </button>
        </header>

        <main class="card">
            <table>
                <thead>
                    <tr>
                        <th>Identitas Pengguna</th>
                        <th>Username</th>
                        <th>Peran / Role</th>
                        <th>Aksi Kelola</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td>
                            <div class="user-info">
                                <div class="avatar <?php echo $user['role']; ?>">
                                    <?php echo strtoupper(substr($user['nama_lengkap'], 0, 1)); ?>
                                </div>
                                <div style="font-weight: 700; color: #0f172a;"><?php echo htmlspecialchars($user['nama_lengkap']); ?></div>
                            </div>
                        </td>
                        <td style="font-family: monospace; color: #64748b; font-weight: 600;"><?php echo htmlspecialchars($user['username']); ?></td>
                        <td>
                            <span class="badge badge-<?php echo $user['role']; ?>">
                                <?php echo ucfirst($user['role']); ?>
                            </span>
                        </td>
                        <td>
                            <div class="action-btns">
                                <button class="btn-edit" onclick="editUser(<?php echo htmlspecialchars(json_encode($user)); ?>)">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    Edit
                                </button>
                                <?php if($user['id'] != $_SESSION['user_id']): ?>
                                <a href="index.php?page=delete_user&id=<?php echo $user['id']; ?>" class="btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                    Hapus
                                </a>
                                <?php else: ?>
                                <span style="font-size: 12px; font-weight: 600; color: #94a3b8; padding-left: 8px;">(Sesi Aktif)</span>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>

    <!-- Modal Add User -->
    <div id="addModal" class="modal">
        <div class="modal-content fade-in">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                <h3 style="font-size: 18px; font-weight: 700;">Daftarkan Pengguna Baru</h3>
                <span style="font-size: 24px; cursor: pointer; color: #94a3b8;" onclick="closeModal('addModal')">&times;</span>
            </div>
            
            <form action="index.php?page=store_user" method="POST">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" required placeholder="Contoh: Budi Santoso">
                </div>
                <div class="form-group">
                    <label>Username (Gunakan Tanpa Spasi)</label>
                    <input type="text" name="username" class="form-control" required placeholder="budi_123">
                </div>
                <div class="form-group">
                    <label>Kata Sandi</label>
                    <input type="password" name="password" class="form-control" required placeholder="••••••••">
                </div>
                <div class="form-group">
                    <label>Otoritas Role</label>
                    <select name="role" class="form-control">
                        <option value="siswa">Siswa (Akses Lapor)</option>
                        <option value="admin">Admin (Akses Kelola)</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeModal('addModal')">Batal</button>
                    <button type="submit" class="btn-save">Simpan Pengguna</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit User -->
    <div id="editModal" class="modal">
        <div class="modal-content fade-in">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                <h3 style="font-size: 18px; font-weight: 700;">Ubah Data Pengguna</h3>
                <span style="font-size: 24px; cursor: pointer; color: #94a3b8;" onclick="closeModal('editModal')">&times;</span>
            </div>
            
            <form action="index.php?page=update_user" method="POST">
                <input type="hidden" name="user_id" id="edit_user_id">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" id="edit_nama_lengkap" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" id="edit_username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Kata Sandi Baru (Kosongkan jika tidak diganti)</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••">
                </div>
                <div class="form-group">
                    <label>Otoritas Role</label>
                    <select name="role" id="edit_role" class="form-control">
                        <option value="siswa">Siswa</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeModal('editModal')">Batal</button>
                    <button type="submit" class="btn-save">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(id) { document.getElementById(id).style.display = "flex"; }
        function closeModal(id) { document.getElementById(id).style.display = "none"; }
        
        function editUser(user) {
            openModal('editModal');
            document.getElementById('edit_user_id').value = user.id;
            document.getElementById('edit_nama_lengkap').value = user.nama_lengkap;
            document.getElementById('edit_username').value = user.username;
            document.getElementById('edit_role').value = user.role;
        }

        window.onclick = function(e) {
            if (e.target == document.getElementById('addModal')) closeModal('addModal');
            if (e.target == document.getElementById('editModal')) closeModal('editModal');
        }
    </script>
</body>
</html>
