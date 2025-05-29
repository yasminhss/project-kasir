<?php
session_start();
require_once "../config/db.php";

$username = $_POST['username'];
$password = $_POST['password'];

// Ambil user berdasarkan username
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Cek password (plaintext — sebaiknya pakai password_hash nanti)
    if ($password === $user['password']) {
        $_SESSION['user'] = $user['username'];

        // Set alert untuk login berhasil
        $_SESSION['alert'] = [
            'type' => 'success',
            'title' => 'Login Berhasil!',
            'text' => 'Selamat datang, ' . $user['username'],
            'redirect' => '../views/dashboard.php'
        ];

        header("Location: ../views/login.php");
        exit;
    } else {
        // Password salah
        $_SESSION['alert'] = [
            'type' => 'error',
            'title' => 'Login Gagal',
            'text' => 'Password salah.'
        ];
        header("Location: ../views/login.php");
        exit;
    }
} else {
    // User tidak ditemukan
    $_SESSION['alert'] = [
        'type' => 'error',
        'title' => 'Login Gagal',
        'text' => 'User tidak ditemukan.'
    ];
    header("Location: ../views/login.php");
    exit;
}
?>
