 <?php
    session_start();
    $connected = isset($_SESSION['login']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TestAuth</title>
</head>
<body>
    <?php if($connected): ?>
        <p>Hello <?= $_SESSION['login'] ?></p>
        <a href="logout.php">Logout</a>
        <a href="admin/index.php">Admin</a>
    <?php else: ?>
        <p>Hello anonymous</p>
        <a href="login.php">Login</a>
    <?php endif; ?>
</body>
</html>
