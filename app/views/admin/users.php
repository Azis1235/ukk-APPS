<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengguna - Admin</title>
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
                <a href="index.php?page=admin_aspirasi">
                    <span>📁</span> Data Aspirasi
                </a>
                <a href="index.php?page=admin_users" class="active">
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
                    <h1>Data Pengguna</h1>
                    <p>Kelola data siswa dan administrator.</p>
                </div>
                <button onclick="document.getElementById('userModal').style.display='flex'" style="padding: 10px 20px; background: var(--sidebar-bg); border: none; border-radius: 12px; font-weight: 700; color: white; cursor: pointer; transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 8px;" onmouseover="this.style.background='#334155'; this.style.transform='translateY(-2px)';" onmouseout="this.style.background='var(--sidebar-bg)'; this.style.transform='translateY(0)';">
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
    </div>

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
