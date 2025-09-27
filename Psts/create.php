<?php
include 'db.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($conn, trim($_POST['nama'] ?? ''));
    $kelas = mysqli_real_escape_string($conn, trim($_POST['kelas'] ?? ''));
    $gender = $_POST['gender'] ?? '';
    $umur = intval($_POST['umur'] ?? 0);

    if ($nama === '' || $kelas === '' || !in_array($gender, ['Laki-laki','Perempuan']) || $umur <= 0) {
        $error = 'Isi semua field dengan benar.';
    } else {
        $sql = "INSERT INTO students (nama, kelas, gender, umur) VALUES ('$nama', '$kelas', '$gender', $umur)";
        if (mysqli_query($conn, $sql)) {
            header('Location: index.php?msg=created');
            exit;
        } else {
            $error = 'DB Error: ' . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Tambah Data</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <div class="card shadow col-md-6 mx-auto">
    <div class="card-body">
      <h3 class="mb-4">➕ Tambah Data Siswa</h3>

      <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form method="post">
        <div class="mb-3">
          <label class="form-label">Nama</label>
          <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Kelas</label>
          <input type="text" name="kelas" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Gender</label><br>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="gender" id="g1" value="Laki-laki" required>
            <label class="form-check-label" for="g1">Laki-laki</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="gender" id="g2" value="Perempuan" required>
            <label class="form-check-label" for="g2">Perempuan</label>
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label">Umur</label>
          <input type="number" name="umur" class="form-control" min="1" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </div>
</div>
</body>
</html>
