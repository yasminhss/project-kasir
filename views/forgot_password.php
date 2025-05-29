<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script src="script.js"></script>
    <!-- Tombol Lupa Password -->
<a href="#" id="forgot-password-link" class="forgot-password"></a>

<!-- Modal (Popup) untuk Reset Password -->
<div id="forgot-password-modal" class="modal hidden">
    <div class="modal-content">
        <span class="close-button">&times;</span>
        <h3>Lupa Password</h3>
        <input type="email" id="email-modal" placeholder="Masukkan email Anda" required>
        <button id="send-reset-link">Kirim</button>
    </div>
</div>  
</body>
</html>