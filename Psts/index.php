<?php
include 'db.php';
$msg = '';
if (isset($_GET['msg'])) {
    if ($_GET['msg'] === 'created') $msg = 'Data berhasil ditambahkan.';
    if ($_GET['msg'] === 'updated') $msg = 'Data berhasil diupdate.';
    if ($_GET['msg'] === 'deleted') $msg = 'Data berhasil dihapus.';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>CRUD Siswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <h2 class="mb-4 text-center">📘 Data Siswa</h2>

  <?php if ($msg): ?>
    <div class="alert alert-success"><?= htmlspecialchars($msg) ?></div>
  <?php endif; ?>

  <div class="mb-3 text-end">
    <a href="create.php" class="btn btn-primary">+ Tambah Data</a>
  </div>

  <div class="card shadow">
    <div class="card-body">
      <table class="table table-bordered table-striped text-center align-middle">
        <thead class="table-dark">
          <tr>
            <th>No</th><th>Nama</th><th>Kelas</th><th>Gender</th><th>Umur</th><th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $res = mysqli_query($conn, "SELECT * FROM students");
          if (!$res) { echo '<tr><td colspan="6">DB Error: '.htmlspecialchars(mysqli_error($conn)).'</td></tr>'; }
          else {
            $no = 1;
            while ($row = mysqli_fetch_assoc($res)) {
              echo '<tr>
                      <td>'.($no++).'</td>
                      <td>'.htmlspecialchars($row['nama']).'</td>
                      <td>'.htmlspecialchars($row['kelas']).'</td>
                      <td>'.htmlspecialchars($row['gender']).'</td>
                      <td>'.htmlspecialchars($row['umur']).'</td>
                      <td>
                        <a href="update.php?id='.intval($row['id']).'" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete.php?id='.intval($row['id']).'" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin hapus?\')">Hapus</a>
                      </td>
                    </tr>';
            }
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
