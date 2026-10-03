<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete') {
    $kode = trim($_POST['kode'] ?? '');

    if ($kode !== '') {
        $stmt = $pdo->prepare('DELETE FROM mata_kuliah WHERE kode = ?');
        $stmt->execute([$kode]);
    }

    header('Location: index.php?deleted=1');
    exit;
}

$query = "SELECT * FROM mata_kuliah";
$stmt = $pdo->prepare($query);
$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$data_mata_kuliah = $result;
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mata Kuliah - MyWeb</title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold me-4" href="#">MyWeb</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Mata Kuliah</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <div class="container my-5">
        <!-- Header Page & Tombol Tambah -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-semibold">Daftar Mata Kuliah</h2>
            <a href="tambah-mata-kuliah.php" class="btn btn-primary">Tambah Mata Kuliah</a>
        </div>

        <?php if (isset($_GET['deleted'])): ?>
            <div class="alert alert-success" role="alert">Data mata kuliah berhasil dihapus.</div>
        <?php endif; ?>
        <?php if (isset($_GET['updated'])): ?>
            <div class="alert alert-success" role="alert">Data mata kuliah berhasil diperbarui.</div>
        <?php endif; ?>
        <?php if (isset($_GET['not_found'])): ?>
            <div class="alert alert-warning" role="alert">Data mata kuliah tidak ditemukan.</div>
        <?php endif; ?>

        <!-- Tabel Data -->
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th scope="col" style="width: 20%;">Kode Mata Kuliah</th>
                        <th scope="col" style="width: 40%;">Nama Mata Kuliah</th>
                        <th scope="col" style="width: 20%;">Semester</th>
                        <th scope="col" style="width: 20%;">Dosen</th>
                        <th scope="col" style="width: 20%;">sks</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data_mata_kuliah)): ?>
                        <?php foreach ($data_mata_kuliah as $row): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['kode']); ?></td>
                                <td><?= htmlspecialchars($row['nama']); ?></td>
                                <td><?= htmlspecialchars($row['semester']); ?></td>
                                <td><?= htmlspecialchars($row['dosen_id']); ?></td>
                                <td><?= htmlspecialchars($row['sks']); ?></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="edit-mata-kuliah.php?kode=<?= urlencode($row['kode']); ?>"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <form method="POST" onsubmit="return confirm('Yakin ingin menghapus mata kuliah ini?');">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="kode" value="<?= htmlspecialchars($row['kode'], ENT_QUOTES, 'UTF-8'); ?>">
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                Belum ada data mata kuliah.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>