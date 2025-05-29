<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Dapur Sunda</title>
    <link rel="stylesheet" href="../css/style-dashboard.css">
</head>
<body>
    <!-- Sidebar -->

    <div class="sidebar">
        <img src="../image/logo-ds.png" alt="Logo Dapur Sunda" class="logo">
        <a href="../views/menu.php" class="icon-link"><img src="../image/logohome.png" alt="Home" class="icon"></a>
        <a href="../views/dashboard.php" class="icon-link active"><img src="../image/dashboard.png" alt="Dashboard" class="icon"></a>
        <a href="../views/list-menu.php" class="icon-link"><img src="../image/list-menu.png" alt="List Menu" class="icon"></a>
        <a href="../actions/logout.php" class="icon-link"><img src="../image/logout.png" alt="Logout" class="icon"></a>
    </div>

    <!-- Main Content -->
    <div class="main">
        <div class="header">
            <h1>Dashboard <i style="font-family: cursive;">Dapur Sunda</i></h1>
            <span class="status">● Online</span>
        </div>

        <div class="stats">
            <div class="stat-card">
                <h3>Total Menu</h3>
                <p id="total-menu">120</p>
            </div>
            <div class="stat-card">
                <h3>Total Order</h3>
                <p id="total-order">23</p>
            </div>
            <div class="stat-card">
                <h3>Total Pendapatan</h3>
                <p id="total-revenue">Rp. 2.000.000</p>
            </div>
        </div>

        <button class="report-button" onclick="printReport()">Cetak Laporan</button>

        <div class="chart-container">
            <h3>Statistik Penjualan</h3>
            <canvas id="sales-chart"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="script-dashboard.js"></script>
</body>
</html>