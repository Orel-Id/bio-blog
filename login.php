<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TestAuth</title>
</head>
<body>
    <h1>Login</h1>
    <?php
        $redirect = 'index.php';
        if (isset($_GET['redirect'])) {
            $redirect = $_GET['redirect'];
        }
    ?>
    <form action="post_login.php" method="POST">
        <label>
            Name
            <input type="text" name="name" required/>
        </label>
        <label>
            Password
            <input type="password" name="password" required/>
        </label>
        <input type="submit" value="Login" />
        <input type="hidden" name="redirect" value="<?= $redirect ?>" />
        <?php if(isset($_GET['error'])): ?>
            <p>Your name or your password is not correct.</p>
        <?php endif ?>
    </form>
</body>
</html>
