<?php
/**
 * Model Aspirasi - SchoolVoice
 * 
 * Class ini bertanggung jawab atas semua interaksi data terkait laporan aspirasi,
 * mulai dari pembuatan, pembacaan dengan filter, hingga pemutakhiran status.
 */
class AspirasiModel {
    private $conn;
    private $table_name = "aspirasi";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Buat aspirasi baru
    // Menangani pembuatan laporan pengaduan baru dari siswa
    public function create($user_id, $kategori_id, $judul, $deskripsi, $lokasi, $foto = null) {
        // Gabungkan lokasi ke deskripsi karena tidak ada kolom lokasi
        $full_deskripsi = $deskripsi;
        if (!empty($lokasi)) {
            $full_deskripsi .= " (Lokasi: " . $lokasi . ")";
        }

        $query = "INSERT INTO " . $this->table_name . " 
                (id_user, id_kategori, judul, deskripsi, tanggal, status, fotobukti) 
                VALUES (:user_id, :kategori_id, :judul, :deskripsi, NOW(), 'pending', :foto)";
        
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $judul = htmlspecialchars(strip_tags($judul));
        $full_deskripsi = htmlspecialchars(strip_tags($full_deskripsi));

        // Bind
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":kategori_id", $kategori_id);
        $stmt->bindParam(":judul", $judul);
        $stmt->bindParam(":deskripsi", $full_deskripsi);
        $stmt->bindParam(":foto", $foto);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Ambil semua aspirasi (untuk admin)
    // Mengambil semua data aspirasi (digunakan oleh Administrator)
    public function getAll() {
        $query = "SELECT a.*, a.id_aspirasi as id, u.nama as nama_pelapor, k.nama_kategori, 
                         f.pesan as feedback_pesan, f.tanggal as feedback_tanggal
                  FROM " . $this->table_name . " a
                  JOIN users u ON a.id_user = u.id_user
                  JOIN kategori k ON a.id_kategori = k.id_kategori
                  LEFT JOIN (
                      SELECT id_aspirasi, pesan, tanggal 
                      FROM feedback 
                      WHERE id_feedback IN (SELECT MAX(id_feedback) FROM feedback GROUP BY id_aspirasi)
                  ) f ON a.id_aspirasi = f.id_aspirasi
                  ORDER BY a.tanggal DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil aspirasi dengan filter
    // Menjalankan pencarian laporan berdasarkan filter (Kategori, Tanggal, Bulan, Tahun)
    public function getFiltered($category = null, $date = null, $month = null, $year = null) {
        $query = "SELECT a.*, a.id_aspirasi as id, u.nama as nama_pelapor, k.nama_kategori, 
                         f.pesan as feedback_pesan, f.tanggal as feedback_tanggal
                  FROM " . $this->table_name . " a
                  JOIN users u ON a.id_user = u.id_user
                  JOIN kategori k ON a.id_kategori = k.id_kategori
                  LEFT JOIN (
                      SELECT id_aspirasi, pesan, tanggal 
                      FROM feedback 
                      WHERE id_feedback IN (SELECT MAX(id_feedback) FROM feedback GROUP BY id_aspirasi)
                  ) f ON a.id_aspirasi = f.id_aspirasi
                  WHERE 1=1";
        
        $params = [];
        
        if (!empty($category)) {
            $query .= " AND a.id_kategori = :category";
            $params[':category'] = $category;
        }
        
        if (!empty($date)) {
            $query .= " AND DATE(a.tanggal) = :date";
            $params[':date'] = $date;
        }
        
        if (!empty($month)) {
            $query .= " AND MONTH(a.tanggal) = :month";
            $params[':month'] = $month;
        }
        
        if (!empty($year)) {
            $query .= " AND YEAR(a.tanggal) = :year";
            $params[':year'] = $year;
        }
        
        $query .= " ORDER BY a.tanggal DESC";
        
        $stmt = $this->conn->prepare($query);
        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val);
        }
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil aspirasi berdasarkan user (untuk siswa)
    public function getByUserId($user_id) {
        $query = "SELECT a.*, a.id_aspirasi as id, k.nama_kategori, 
                         f.pesan as feedback_pesan, f.tanggal as feedback_tanggal
                  FROM " . $this->table_name . " a
                  JOIN kategori k ON a.id_kategori = k.id_kategori
                  LEFT JOIN (
                      SELECT id_aspirasi, pesan, tanggal 
                      FROM feedback 
                      WHERE id_feedback IN (SELECT MAX(id_feedback) FROM feedback GROUP BY id_aspirasi)
                  ) f ON a.id_aspirasi = f.id_aspirasi
                  WHERE a.id_user = :user_id
                  ORDER BY a.tanggal DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Ambil detail aspirasi
    public function getById($id) {
        $query = "SELECT a.*, a.id_aspirasi as id, u.nama as nama_pelapor, k.nama_kategori 
                  FROM " . $this->table_name . " a
                  JOIN users u ON a.id_user = u.id_user
                  JOIN kategori k ON a.id_kategori = k.id_kategori
                  WHERE a.id_aspirasi = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update status aspirasi
    // Memperbarui status pengerjaan laporan (Pending, Proses, Selesai)
    public function updateStatus($id, $status) {
        $query = "UPDATE " . $this->table_name . " SET status = :status WHERE id_aspirasi = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    // Get statistics for dashboard
    public function getStatistics() {
        $stats = [
            'total' => 0,
            'pending' => 0,
            'proses' => 0,
            'selesai' => 0,
            'ditolak' => 0
        ];

        // Total
        $stmt = $this->conn->query("SELECT COUNT(*) as total FROM " . $this->table_name);
        $total = $stmt->fetch(PDO::FETCH_ASSOC);
        $stats['total'] = $total['total'];

        // Status counts
        $stmt = $this->conn->query("SELECT status, COUNT(*) as count FROM " . $this->table_name . " GROUP BY status");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $stats[$row['status']] = $row['count'];
        }

        return $stats;
    }
    // Hapus aspirasi
    public function delete($id) {
        try {
            // Hapus feedback terkait dulu
            $queryFeedback = "DELETE FROM feedback WHERE id_aspirasi = :id";
            $stmtFeedback = $this->conn->prepare($queryFeedback);
            $stmtFeedback->bindParam(":id", $id);
            $stmtFeedback->execute();

            // Hapus data aspirasi
            $query = "DELETE FROM " . $this->table_name . " WHERE id_aspirasi = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>
