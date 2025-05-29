// JavaScript untuk Halaman Login

// Ambil elemen tombol login
const loginButton = document.getElementById('login-button');

loginButton.addEventListener('click', function(event) {
    event.preventDefault();
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    // Validasi login
    if ((email === "admin@dapur.com" && password === "admin123") ||
        (email === "kasir@gmail.com" && password === "kasir123")) {
        window.location.href = "menu.html"; // Redirect ke halaman pemesanan
    } else {
        alert("Email atau password salah!");
    }
});

// JavaScript untuk menangani tombol reset password

// Tangani tombol reset password (di halaman lupa password)
const resetButton = document.getElementById('reset-button');

if (resetButton) {
    resetButton.addEventListener('click', function(event) {
        event.preventDefault(); // Mencegah form submit secara default

        const email = document.getElementById('email-reset').value;

        if (email) {
            alert('Tautan reset password telah dikirim ke email Anda.');
            window.location.href = "index.html"; // Redirect ke halaman login
        } else {
            alert('Masukkan email Anda!');
        }
    });
}

// Modal handling
const modal = document.getElementById('forgot-password-modal');
const forgotPasswordLink = document.getElementById('forgot-password-link');
const closeButton = document.querySelector('.close-button');
const sendResetLink = document.getElementById('send-reset-link');

// Show modal when "Lupa password?" is clicked
forgotPasswordLink.addEventListener('click', function(event) {
    event.preventDefault();
    modal.style.display = 'flex'; // Tampilkan modal
    modal.classList.remove('hidden'); // Hapus class hidden jika ada
});

// Close modal when 'X' is clicked
closeButton.addEventListener('click', function() {
    modal.style.display = 'none'; // Sembunyikan modal
    modal.classList.add('hidden'); // Tambahkan class hidden kembali
});

// Handle "Kirim" button
sendResetLink.addEventListener('click', function() {
    const email = document.getElementById('email-modal').value;

    if (email) {
        alert('Tautan reset password telah dikirim ke email Anda.');
        modal.style.display = 'none'; // Tutup modal
        modal.classList.add('hidden'); // Tambahkan class hidden
    } else {
        alert('Masukkan email Anda!');
    }
});

// Redirect ke halaman pemesanan setelah login sukses
loginButton.addEventListener('click', function(event) {
    event.preventDefault(); // Mencegah submit default
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    if (email === "admin@dapur.com" && password === "admin123") {
        window.location.href = "menu.html"; // Arahkan ke halaman pemesanan
    } else {
        alert("Email atau password salah!");
    }
});