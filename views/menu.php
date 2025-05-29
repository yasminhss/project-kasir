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
  <title>Pemesanan Menu - Dapur Sunda</title>
  <link rel="stylesheet" href="../css/style-menu.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="sidebar">
        <!-- Logo Dapur Sunda -->
        <img src="../image/logo-ds.png" alt="Logo Dapur Sunda" class="logo">
      
        <!-- Menu Sidebar -->
        <a href="../views/menu.php" class="icon-link active"><img src="../image/logohome.png" alt="Home" class="icon"></a>
        <a href="../views/dashboard.php" class="icon-link"><img src="../image/dashboard.png" alt="Dashboard" class="icon"></a>
        <a href="../views/list-menu.php" class="icon-link"><img src="../image/list-menu.png" alt="List Menu" class="icon"></a>
        <a href="../actions/logout.php" class="icon-link"><img src="../image/logout.png" alt="Logout" class="icon"></a>
    </div>
    
    <!-- Main Content -->
    <div class="main">
        <div class="header">
            <h1>Menu <i style="font-family: cursive;">Dapur Sunda</i></h1>
            <div class="dropdown">
                <select id="category-filter">
                    <option value="all">Tampilkan semua</option>
                    <option value="Makanan">Makanan</option>
                    <option value="Minuman">Minuman</option>
                    <option value="Camilan">Camilan</option>
                </select>
            </div>
        </div>

        <div class="menu-grid container">
  <div class="row">
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
    ?>
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow">
          <img src="../image/<?= $row['foto'] ?>" class="card-img-top" alt="<?= $row['nama_menu'] ?>" style="height: 200px; object-fit: cover;">
          <div class="card-body">
            <h5 class="card-title"><?= $row['nama_menu'] ?></h5>
            <p class="card-text"><?= $row['kategori'] ?></p>
            <p class="card-text fw-bold">Rp<?= number_format($row['harga'], 0, ',', '.') ?></p>
            <button class="btn btn-success w-100 add-to-cart" data-id="<?= $row['id'] ?>">Tambah ke Keranjang</button>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

    </div>

    <!-- Cart -->
    <div class="cart">
        <h2>Keranjang 🛒</h2>
        <div class="mode-buttons">
            <button class="mode-btn" id="dine-in-btn">Dine In</button>
            <button class="mode-btn" id="take-away-btn">Take Away</button>
        </div>
        <button class="cancel" id="cancel-order">Batalkan Pesanan</button>

        <div id="cart-items">
            <!-- Keranjang akan diisi oleh JavaScript -->
        </div>

        <div class="total">
            <h3>Total Bayar: Rp. <span id="total-price">0</span></h3>
        </div>

        <div class="order-info">
            <label>No. Order</label>
            <input type="text" id="order-number" value="#A0020">
            <label>Nama Pelanggan</label>
            <input type="text" id="customer-name" placeholder="Masukkan nama pelanggan">
            <label>Catatan</label>
            <textarea id="order-notes" placeholder="Contoh: Tidak pedas"></textarea>
            <label>No. Meja</label>
            <input type="text" id="table-number" placeholder="Masukkan nomor meja">
        </div>

        <div class="btns">
            <button id="save-bill">Simpan Bill</button>
            <button id="print-bill">Cetak Bill</button>
        </div>
        <button class="pay" id="pay-button">Bayar</button>
    </div>

    <!-- Modal Pilihan Pembayaran -->
<div id="payment-modal" class="modal">
    <div class="modal-content">
        <h2>Pilih Metode Pembayaran</h2>
        <button class="payment-option" id="qris-button">Qris</button>
        <button class="payment-option" id="cash-button">Tunai</button>
    </div>
</div>

    <!-- Modal QR Code -->
    <div id="qris-modal" class="modal">
        <div class="modal-content">
            <h2>Dapur Sunda</h2>
            <img src="image/logo-qris.png" alt="QR Code" class="qr-code">
            <p>Scan Me</p>
            <div class="btn-group">
                <button class="cancel" id="cancel-qris">Cancel</button>
                <button class="success" id="finish-qris">Selesai</button>
            </div>
        </div>
    </div>

    <!-- Modal Transaksi Berhasil -->
    <div id="success-modal" class="modal">
        <div class="modal-content">
            <h2>Qris</h2>
            <img src="image/berhasil.png" alt="Success Icon" class="success-icon">
            <h3>Transaksi Berhasil!</h3>
            <p>Terimakasih dan Selamat Menikmati</p>
            <button class="success" id="close-success">Selesai</button>
        </div>
    </div>

    <div id="success-modal" class="modal">
        <div class="modal-content">
            <h2>Tunai</h2>
            <img src="image/berhasil.png" alt="Success Icon" class="success-icon">
            <h3>Transaksi Berhasil!</h3>
            <p>Terimakasih dan Selamat Menikmati</p>
            <button class="success" id="close-success">Selesai</button>
        </div>
    </div>

    <script src="script-menu.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>