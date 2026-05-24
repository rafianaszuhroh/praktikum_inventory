<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    die("Akses ditolak");
}

$id = $_GET['id'];

// Mengambil data barang berdasarkan ID
$data = mysqli_query($koneksi, "SELECT * FROM barang WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {
    $nama               = $_POST['nama'];
    $status_barang      = $_POST['status_barang'];
    $penyimpanan_barang = $_POST['penyimpanan_barang'];
    $harga              = $_POST['harga'];

    // Update data langsung ke kolom teks masing-masing
    mysqli_query($koneksi, "
        UPDATE barang SET
        nama_barang='$nama',
        status_barang='$status_barang',
        penyimpanan_barang='$penyimpanan_barang',
        harga_barang='$harga'
        WHERE id='$id'
    ");

    echo "
    <script>
        alert('Data berhasil diupdate');
        window.location='index.php';
    </script>
    ";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Barang</title>
    <link rel="stylesheet" href="../AdminLTE-4.0.0-rc7/dist/css/adminlte.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-warning card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Edit Barang</h3>
                    </div>

                    <form method="POST">
                        <div class="card-body">
                            <div class="mb-3">
                                <label>Nama Barang</label>
                                <input type="text" name="nama" class="form-control" value="<?= $row['nama_barang']; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label>Status Barang</label>
                                <select name="status_barang" class="form-control">
                                    <option value="Tersedia" <?= ($row['status_barang'] == 'Tersedia') ? 'selected' : ''; ?>>Tersedia</option>
                                    <option value="Dipinjam" <?= ($row['status_barang'] == 'Dipinjam') ? 'selected' : ''; ?>>Dipinjam</option>
                                    <option value="Habis" <?= ($row['status_barang'] == 'Habis') ? 'selected' : ''; ?>>Habis</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Penyimpanan</label>
                                <select name="penyimpanan_barang" class="form-control">
                                    <option value="Gudang A" <?= ($row['penyimpanan_barang'] == 'Gudang A') ? 'selected' : ''; ?>>Gudang A</option>
                                    <option value="Gudang B" <?= ($row['penyimpanan_barang'] == 'Gudang B') ? 'selected' : ''; ?>>Gudang B</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Harga Barang</label>
                                <input type="number" name="harga" class="form-control" value="<?= $row['harga_barang']; ?>" required>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" name="update" class="btn btn-warning">Update</button>
                            <a href="index.php" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>