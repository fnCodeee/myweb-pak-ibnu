<?php
include("koneksi.php");

if (isset($_POST['submit'])) {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $semester = $_POST['semester'];
    $dosen_id = $_POST['dosen_id'];
    $sks = $_POST['sks'];

    $query = 'INSERT INTO mata_kuliah (kode, nama, semester, dosen_id, sks) VALUES (?, ?, ?, ?, ?)';

    $stmt = $pdo->prepare($query);
    $stmt->execute([$kode, $nama, $semester, $dosen_id, $sks]);
    echo "<script> alert('Data mata kuliah berhasil ditambahkan!'); window.location.href = 'index.php'; </script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tambah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid px-4"> <a class="navbar-brand fw-bold me-4" href="index.php">MyWeb</a>
            <div class="navbar-nav"> <a class="nav-link" href="index.php">Beranda</a> <a class="nav-link active"
                    href="index.php">Mata Kuliah</a> </div>
        </div>
    </nav> <!-- Form Tambah -->
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-semibold">Tambah Mata Kuliah</h2> <a href="index.php" class="btn btn-secondary">Kembali</a>
        </div>
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <form method="POST">
                    <div class="mb-3"> <label class="form-label">Kode Mata Kuliah</label> <input type="text" name="kode"
                            class="form-control" placeholder="Contoh: ICT015" required> </div>
                    <div class="mb-3"> <label class="form-label">Nama Mata Kuliah</label> <input type="text" name="nama"
                            class="form-control" placeholder="Masukkan nama mata kuliah" required> </div>
                    <div class="mb-3"> <label class="form-label">Semester</label> <input type="number" name="semester"
                            class="form-control" min="1" max="14" placeholder="Contoh: 3" required> </div>
                    <div class="mb-3"> <label class="form-label">Dosen ID</label> <input type="number" name="dosen_id"
                            class="form-control" placeholder="Contoh: 301" required> </div>
                    <div class="mb-4"> <label class="form-label">SKS</label> <select name="sks" class="form-select"
                            required>
                            <option value="">Pilih SKS</option>
                            <option value="2">2 SKS</option>
                            <option value="3">3 SKS</option>
                        </select> </div> <button type="submit" name="submit" class="btn btn-primary"> Simpan Mata Kuliah
                    </button> <a href="index.php" class="btn btn-outline-secondary"> Batal </a>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>