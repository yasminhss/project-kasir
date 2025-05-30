<?php
include '../config/db.php';

$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : 'all';
$query = "SELECT * FROM list_menu";
if ($kategori !== 'all') {
    $kategori = $conn->real_escape_string($kategori);
    $query .= " WHERE kategori = '$kategori'";
}
$result = $conn->query($query);

if (!$result) {
    die("Query gagal: " . $conn->error);
}

// Cek pesan sukses/gagal dari redirect
$success = isset($_GET['success']) ? $_GET['success'] : '';
$error = isset($_GET['error']) ? $_GET['error'] : '';
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
        <a href="../actions/logout.php" class="icon-link" onclick="return confirm('Yakin ingin logout?')"><img src="../image/logout.png" alt="Logout" class="icon"></a>
    </div>

    <!-- Main Content -->
    <div class="main">
        <div class="header">
            <h1>List Menu <i style="font-family: cursive;">Dapur Sunda</i></h1>
            <span class="status">Admin ● Online</span>
        </div>

        <!-- Notifikasi -->
        <?php if ($success): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($success); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($error); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Button and Filter -->
        <div class="container mt-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <button type="button" class="btn btn-primary" onclick="openCreateModal()">Tambah Menu</button>
                <select class="form-select w-auto" id="filter-category" onchange="filterMenu()">
                    <option value="all" <?php echo $kategori == 'all' ? 'selected' : ''; ?>>Tampilkan semua</option>
                    <option value="Makanan" <?php echo $kategori == 'Makanan' ? 'selected' : ''; ?>>Makanan</option>
                    <option value="Minuman" <?php echo $kategori == 'Minuman' ? 'selected' : ''; ?>>Minuman</option>
                </select>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="" method="post" enctype="multipart/form-data" id="menuForm">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTitle">Tambah Menu</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" id="menu-id">
                                <div class="mb-3">
                                    <label for="nama_menu" class="form-label">Nama Menu</label>
                                    <input type="text" name="nama_menu" class="form-control" id="nama_menu" required>
                                </div>
                                <div class="mb-3">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <select name="kategori" class="form-control" id="kategori" required>
                                        <option value="Makanan">Makanan</option>
                                        <option value="Minuman">Minuman</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input type="number" name="harga" class="form-control" id="harga" required>
                                </div>
                                <div class="mb-3">
                                    <label for="foto" class="form-label">Foto</label>
                                    <input type="file" name="foto" class="form-control" id="foto" accept="image/*">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No.</th>
                        <th>Nama Menu</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="menu-list">
                    <?php
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo htmlspecialchars($row['nama_menu']); ?></td>
                            <td><?php echo htmlspecialchars($row['kategori']); ?></td>
                            <td>Rp<?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                            <td>
                                <img src="../upload/<?php echo htmlspecialchars($row['foto'] ?: 'default.png'); ?>" width="70">
                            </td>
                            <td>
                                <button class="btn btn-primary btn-sm" onclick='openEditModal(<?php echo json_encode($row); ?>)'>Edit</button>
                                <a href="../actions/delete-menu.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        setTimeout(function() {
            const alert = document.querySelector('.alert');
            if (alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        }, 3000);

        if (window.location.search.includes('success') || window.location.search.includes('error')) {
            const url = new URL(window.location.href);
            url.searchParams.delete('success');
            url.searchParams.delete('error');
            window.history.replaceState({}, document.title, url.pathname + url.search);
        }

        function openCreateModal() {
            const form = document.getElementById('menuForm');
            form.action = '../actions/list_menu/create_list_menu.php';
            form.reset();
            document.getElementById('modalTitle').innerText = 'Tambah Menu';
            document.getElementById('menu-id').value = '';
            document.getElementById('nama_menu').value = '';
            document.getElementById('kategori').value = 'Makanan';
            document.getElementById('harga').value = '';
            document.getElementById('foto').setAttribute('required', 'required');
            new bootstrap.Modal(document.getElementById('exampleModal')).show();
        }

        function openEditModal(menu) {
            const form = document.getElementById('menuForm');
            form.action = '../actions/list_menu/update_list_menu.php';
            document.getElementById('modalTitle').innerText = 'Edit Menu';
            document.getElementById('menu-id').value = menu.id;
            document.getElementById('nama_menu').value = menu.nama_menu;
            document.getElementById('kategori').value = menu.kategori;
            document.getElementById('harga').value = menu.harga;
            document.getElementById('foto').removeAttribute('required');
            new bootstrap.Modal(document.getElementById('exampleModal')).show();
        }

        function filterMenu() {
            const kategori = document.getElementById('filter-category').value;
            window.location.href = `list-menu.php?kategori=${kategori}`;
        }
    </script>
</body>

</html>