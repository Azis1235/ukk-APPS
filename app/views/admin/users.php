<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengguna - Admin</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
    <style>
        body {
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            color: #0f172a;
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
        .badge-admin { background-color: #dbeafe; color: #1e40af; }
        .badge-siswa { background-color: #f1f5f9; color: #475569; }
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
                <a href="index.php?page=admin_dashboard" style="text-decoration: none; color: #64748b; font-weight: 500; font-size: 14px; transition: color 0.2s;" onmouseover="this.style.color='#0f172a'" onmouseout="this.style.color='#64748b'">Dashboard</a>
                <a href="index.php?page=admin_aspirasi" style="text-decoration: none; color: #64748b; font-weight: 500; font-size: 14px; transition: color 0.2s;" onmouseover="this.style.color='#0f172a'" onmouseout="this.style.color='#64748b'">Data Aspirasi</a>
                <a href="index.php?page=admin_users" style="text-decoration: none; color: #3b82f6; font-weight: 600; font-size: 14px;">Data Pengguna</a>
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
        <header style="margin-bottom: 40px; display: flex; justify-content: space-between; align-items: center;" class="fade-in">
            <div>
                <h1 style="font-size: 32px; font-weight: 800; letter-spacing: -1px; color: #0f172a; margin-bottom: 8px;">Data Pengguna</h1>
                <p style="color: #64748b; font-size: 16px; margin: 0;">Kelola data siswa dan administrator.</p>
            </div>
            <button onclick="document.getElementById('userModal').style.display='flex'" style="padding: 10px 20px; background: #3b82f6; border: none; border-radius: 12px; font-weight: 700; color: white; cursor: pointer; transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 8px;" onmouseover="this.style.background='#2563eb'; this.style.transform='translateY(-2px)';" onmouseout="this.style.background='#3b82f6'; this.style.transform='translateY(0)';">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Tambah Pengguna
            </button>
        </header>

            <div class="card-base fade-in">
                <table>
                    <thead>
                        <tr>
                            <th>Nama Lengkap</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <div class="avatar" style="background: <?php echo $user['role'] == 'admin' ? 'var(--sidebar-bg)' : '#e2e8f0'; ?>; color: <?php echo $user['role'] == 'admin' ? 'white' : 'var(--text-secondary)'; ?>;">
                                        <?php echo strtoupper(substr($user['nama_lengkap'], 0, 1)); ?>
                                    </div>
                                    <?php echo $user['nama_lengkap']; ?>
                                </div>
                            </td>
                            <td><?php echo $user['username']; ?></td>
                            <td>
                                <span class="badge badge-<?php echo $user['role']; ?>">
                                    <?php echo ucfirst($user['role']); ?>
                                </span>
                            </td>
                            <td>
                                <div style="display: flex; gap: 8px;">
                                    <button onclick="editUser(<?php echo htmlspecialchars(json_encode($user)); ?>)" style="text-decoration: none; color: var(--accent); font-weight: 600; font-size: 13px; padding: 6px 12px; border: 1px solid #dbeafe; background: #eff6ff; border-radius: 8px; transition: all 0.2s ease; display: inline-flex; align-items: center; gap: 4px; cursor: pointer;" onmouseover="this.style.background='var(--accent)'; this.style.color='white';" onmouseout="this.style.background='#eff6ff'; this.style.color='var(--accent)';">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                        Edit
                                    </button>
                                    <?php if($user['id'] != $_SESSION['user_id']): ?>
                                    <a href="index.php?page=delete_user&id=<?php echo $user['id']; ?>" onclick="return confirm('Yakin ingin menghapus user ini?')" style="text-decoration: none; color: #ef4444; font-weight: 600; font-size: 13px; padding: 6px 12px; background: #fef2f2; border-radius: 8px; transition: all 0.2s ease; display: inline-flex; align-items: center; gap: 4px;" onmouseover="this.style.background='#ef4444'; this.style.color='white';" onmouseout="this.style.background='#fef2f2'; this.style.color='#ef4444';">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                        Hapus
                                    </a>
                                    <?php else: ?>
                                    <span style="color: var(--text-secondary); font-size: 13px; margin-left: 8px;">(Saya)</span>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
        </main>

    <!-- Modal Add User -->
    <div id="userModal" class="modal-overlay">
        <div class="modal-content fade-in">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                <h3 style="font-size: 18px; font-weight: 700;">Tambah Pengguna Baru</h3>
                <span style="font-size: 24px; cursor: pointer; color: #9ca3af;" onclick="document.getElementById('userModal').style.display='none'">&times;</span>
            </div>
            
            <form action="index.php?page=store_user" method="POST">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select name="role" class="form-control">
                        <option value="siswa">Siswa</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div style="display: flex; gap: 12px; justify-content: flex-end; margin-top: 32px;">
                    <button type="button" class="btn btn-secondary" onclick="document.getElementById('userModal').style.display='none'">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                        Simpan User
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal Edit User -->
    <div id="editUserModal" class="modal-overlay">
        <div class="modal-content fade-in">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                <h3 style="font-size: 18px; font-weight: 700;">Edit Data Pengguna</h3>
                <span style="font-size: 24px; cursor: pointer; color: #9ca3af;" onclick="document.getElementById('editUserModal').style.display='none'">&times;</span>
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
                    <label>Password (Kosongkan jika tidak diganti)</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••">
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select name="role" id="edit_role" class="form-control">
                        <option value="siswa">Siswa</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div style="display: flex; gap: 12px; justify-content: flex-end; margin-top: 32px;">
                    <button type="button" class="btn btn-secondary" onclick="document.getElementById('editUserModal').style.display='none'">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                        Update User
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function editUser(user) {
            document.getElementById('editUserModal').style.display = 'flex';
            document.getElementById('edit_user_id').value = user.id;
            document.getElementById('edit_nama_lengkap').value = user.nama_lengkap;
            document.getElementById('edit_username').value = user.username;
            document.getElementById('edit_role').value = user.role;
        }

        // Close on overlay click
        window.onclick = function(event) {
            const addModal = document.getElementById('userModal');
            const editModal = document.getElementById('editUserModal');
            if (event.target == addModal) addModal.style.display = "none";
            if (event.target == editModal) editModal.style.display = "none";
        }
    </script>
</body>
</html>
