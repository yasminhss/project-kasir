<?php
include '../config/db.php';

$query = "SELECT * FROM list_menu";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Menu - Dapur Sunda</title>
    <link rel="stylesheet" href="../css/style-list-menu.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <img src="../image/logo-ds.png" alt="Logo Dapur Sunda" class="logo">
        <a href="../views/menu.php" class="icon-link"><img src="../image/logohome.png" alt="Home" class="icon"></a>
        <a href="../views/dashboard.php" class="icon-link"><img src="../image/dashboard.png" alt="Dashboard" class="icon"></a>
        <a href="../views/list-menu.php" class="icon-link active"><img src="../image/list-menu.png" alt="List Menu" class="icon"></a>
        <a href="../actions/logout.php" class="icon-link"><img src="../image/logout.png" alt="Logout" class="icon"></a>
    </div>

    <!-- Main Content -->
    <div class="main">
        <div class="header">
            <h1>List Menu <i style="font-family: cursive;">Dapur Sunda</i></h1>
            <span class="status">Admin ● Online</span>
        </div>

        <!-- Button and Filter -->
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <button class="btn btn-success">Buat Data</button>
            <select class="form-select w-auto" id="filter-category">
                <option value="all">Tampilkan semua</option>
                <option value="makanan">Makanan</option>
                <option value="minuman">Minuman</option>
            </select>
        </div>
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No.</th>
                    <th>Nama Menu</th>
                    <th>Kategori Menu</th>
                    <th>Harga Menu</th>
                    <th>Foto Menu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="menu-list">
    <?php
    $no = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$no}</td>";
        echo "<td>{$row['nama_menu']}</td>";
        echo "<td>{$row['kategori']}</td>";
        echo "<td>Rp" . number_format($row['harga'], 0, ',', '.') . "</td>";
        echo "<td><img src='../image/{$row['foto']}' alt='{$row['nama_menu']}' width='70'></td>";
        echo "<td>
                <a href='edit-menu.php?id={$row['id']}' class='btn btn-primary btn-sm'>Edit</a>
                <a href='../actions/delete-menu.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Yakin ingin hapus?')\">Hapus</a>
              </td>";
        echo "</tr>";
        $no++;
    }
    ?>
</tbody>

        </table>
    </div>

    <script src="script-list-menu.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
