<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    <?php
        session_start();
        $connected = isset($_SESSION['login']);
        if (!$connected) {
            header('location: ../login.php?redirect=' . urlencode('admin/index.php'));
        }
    ?>

    <h1>Administration</h1>
    <a href="../index.php">Home</a>
</body>
</html>
