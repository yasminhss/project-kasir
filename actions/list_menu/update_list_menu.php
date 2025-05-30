<?php
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nama_menu = $_POST['nama_menu'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $foto = $_FILES['foto'];

    // Validasi input
    if (empty($id) || empty($nama_menu) || empty($kategori) || empty($harga)) {
        die("Semua field wajib diisi!");
    }

    // Cek apakah ada foto baru
    $foto_name = '';
    if (!empty($foto['name'])) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $max_size = 2 * 1024 * 1024; // 2MB
        if (!in_array($foto['type'], $allowed_types)) {
            die("Tipe file tidak didukung. Gunakan JPEG, PNG, atau GIF.");
        }
        if ($foto['size'] > $max_size) {
            die("Ukuran file terlalu besar. Maksimal 2MB.");
        }
        $foto_name = time() . '_' . basename($foto['name']);
        $target_file = "../image/" . $foto_name;
        if (!move_uploaded_file($foto['tmp_name'], $target_file)) {
            die("Gagal mengunggah foto.");
        }
    }

    // Update database
    if ($foto_name) {
        $stmt = $conn->prepare("UPDATE list_menu SET nama_menu = ?, kategori = ?, harga = ?, foto = ? WHERE id = ?");
        $stmt->bind_param("ssisi", $nama_menu, $kategori, $harga, $foto_name, $id);
    } else {
        $stmt = $conn->prepare("UPDATE list_menu SET nama_menu = ?, kategori = ?, harga = ? WHERE id = ?");
        $stmt->bind_param("ssii", $nama_menu, $kategori, $harga, $id);
    }

    if ($stmt->execute()) {
        header("Location: ../views/list-menu.php?success=Menu berhasil diupdate");
    } else {
        die("Gagal mengupdate menu: " . $conn->error);
    }

    $stmt->close();
}
$conn->close();
?>
