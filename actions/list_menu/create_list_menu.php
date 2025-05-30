<?php
include '../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_menu = $_POST['nama_menu'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $foto = $_FILES['foto'];

    // Validasi input
    if (empty($nama_menu) || empty($kategori) || empty($harga)) {
        die("Semua field wajib diisi!");
    }

    // Validasi dan upload foto
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

        // Hapus karakter aneh dari nama file
        $clean_name = preg_replace("/[^a-zA-Z0-9\._-]/", "_", basename($foto['name']));
        $foto_name = time() . '_' . $clean_name;

        $target_dir = "../../upload/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $target_file = $target_dir . $foto_name;

        if (!move_uploaded_file($foto['tmp_name'], $target_file)) {
            die("Gagal mengunggah foto.");
        }
    }

    // Simpan ke database
    $stmt = $conn->prepare("INSERT INTO list_menu (nama_menu, kategori, harga, foto) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $nama_menu, $kategori, $harga, $foto_name);

    if ($stmt->execute()) {
        header("Location: ../../views/list-menu.php?success=Menu berhasil ditambahkan");
    } else {
        die("Gagal menambahkan menu: " . $conn->error);
    }

    $stmt->close();
}
$conn->close();
