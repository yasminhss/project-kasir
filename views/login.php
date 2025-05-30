<?php
session_start();
$alert = $_SESSION['alert'] ?? null;
unset($_SESSION['alert']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dapur Sunda</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body style="background-color: 3498DB;">

    <?php if ($alert): ?>
        <script>
            Swal.fire({
                icon: '<?= $alert["type"] ?>',
                title: '<?= $alert["title"] ?>',
                text: '<?= $alert["text"] ?>',
                timer: <?= $alert["type"] === 'success' ? 2000 : 'null' ?>,
                showConfirmButton: <?= $alert["type"] === 'success' ? 'false' : 'true' ?>
            }).then(() => {
                <?php if (isset($alert["redirect"])): ?>
                    window.location.href = '<?= $alert["redirect"] ?>';
                <?php endif; ?>
            });
        </script>
    <?php endif; ?>

    <div class="login-container">
        <form class="login-form" method="post" action="../actions/login.php">
            <h2>Form Login</h2>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <a href="../view/help.php" class="forgot-password">Lupa password?</a>
            <button type="submit" id="login-button">Login</button>
        </form>
    </div>

</body>

</html>