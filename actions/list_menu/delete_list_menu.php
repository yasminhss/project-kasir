<?php
include '../config/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil nama file foto untuk dihapus
    $stmt = $conn->prepare("SELECT foto FROM list_menu WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    // Hapus file foto jika ada
    if ($row['foto'] && file_exists("../image/" . $row['foto'])) {
        unlink("../image/" . $row['foto']);
    }

    // Hapus data dari database
    $stmt = $conn->prepare("DELETE FROM list_menu WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header("Location: ../views/list-menu.php?success=Menu berhasil dihapus");
    } else {
        die("Gagal menghapus menu: " . $conn->error);
    }
    
    $stmt->close();
}
$conn->close();
?>