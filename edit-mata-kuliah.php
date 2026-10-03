<?php
include 'koneksi.php';

$kode_awal = trim($_POST['kode_awal'] ?? $_GET['kode'] ?? '');

if ($kode_awal === '') {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode = trim($_POST['kode'] ?? '');
    $nama = trim($_POST['nama'] ?? '');
    $semester = trim($_POST['semester'] ?? '');
    $dosen_id = trim($_POST['dosen_id'] ?? '');
    $sks = trim($_POST['sks'] ?? '');

    $query = 'UPDATE mata_kuliah SET kode = ?, nama = ?, semester = ?, dosen_id = ?, sks = ? WHERE kode = ?';
    $stmt = $pdo->prepare($query);
    $stmt->execute([$kode, $nama, $semester, $dosen_id, $sks, $kode_awal]);

    header('Location: index.php?updated=1');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM mata_kuliah WHERE kode = ?');
$stmt->execute([$kode_awal]);
$mata_kuliah = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$mata_kuliah) {
    header('Location: index.php?not_found=1');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mata Kuliah - MyWeb</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold me-4" href="index.php">MyWeb</a>
            <div class="navbar-nav">
                <a class="nav-link" href="index.php">Beranda</a>
                <a class="nav-link active" href="index.php">Mata Kuliah</a>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-semibold">Edit Mata Kuliah</h2>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-4">
                <form method="POST">
                    <input type="hidden" name="kode_awal" value="<?= htmlspecialchars($kode_awal, ENT_QUOTES, 'UTF-8'); ?>">
                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode Mata Kuliah</label>
                        <input type="text" id="kode" name="kode" class="form-control"
                            value="<?= htmlspecialchars($mata_kuliah['kode'], ENT_QUOTES, 'UTF-8'); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Mata Kuliah</label>
                        <input type="text" id="nama" name="nama" class="form-control"
                            value="<?= htmlspecialchars($mata_kuliah['nama'], ENT_QUOTES, 'UTF-8'); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="semester" class="form-label">Semester</label>
                        <input type="number" id="semester" name="semester" class="form-control" min="1" max="14"
                            value="<?= htmlspecialchars($mata_kuliah['semester'], ENT_QUOTES, 'UTF-8'); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="dosen_id" class="form-label">Dosen ID</label>
                        <input type="number" id="dosen_id" name="dosen_id" class="form-control"
                            value="<?= htmlspecialchars($mata_kuliah['dosen_id'], ENT_QUOTES, 'UTF-8'); ?>" required>
                    </div>
                    <div class="mb-4">
                        <label for="sks" class="form-label">SKS</label>
                        <select id="sks" name="sks" class="form-select" required>
                            <option value="2" <?= (string) $mata_kuliah['sks'] === '2' ? 'selected' : ''; ?>>2 SKS</option>
                            <option value="3" <?= (string) $mata_kuliah['sks'] === '3' ? 'selected' : ''; ?>>3 SKS</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="index.php" class="btn btn-outline-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>