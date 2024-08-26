<?php
include('koneksi.php');

// Validasi dan sanitasi input ID
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Gunakan prepared statement untuk mencegah SQL injection
    $stmt = $connection->prepare("SELECT * FROM tbl_siswa WHERE id_siswa = ? LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Cek apakah ada hasil yang ditemukan
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan!";
        exit;
    }

    $stmt->close();
} else {
    echo "ID tidak valid!";
    exit;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Edit Siswa</title>
</head>
<body>

<div class="container" style="margin-top: 80px">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    EDIT SISWA
                </div>
                <div class="card-body">
                    <form action="update-siswa.php" method="POST">
                        <div class="form-group">
                            <label>NISN</label>
                            <input type="text" name="nisn" value="<?php echo htmlspecialchars($row['nisn']); ?>" placeholder="Masukkan NISN Siswa" class="form-control">
                            <input type="hidden" name="id_siswa" value="<?php echo htmlspecialchars($row['id_siswa']); ?>">
                        </div>

                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" value="<?php echo htmlspecialchars($row['nama_lengkap']); ?>" placeholder="Masukkan Nama Siswa" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" name="alamat" placeholder="Masukkan Alamat Siswa" rows="4"><?php echo htmlspecialchars($row['alamat']); ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-success">UPDATE</button>
                        <button type="reset" class="btn btn-warning">RESET</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
