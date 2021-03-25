<?php
$correct_login = 'bob';
$correct_password = password_hash('password', PASSWORD_DEFAULT);

if (
    isset($_POST['name']) &&
    isset($_POST['password']) &&
    $_POST['name'] == $correct_login &&
    password_verify($_POST['password'], $correct_password)
) {
    session_start();
    $_SESSION['login'] = $_POST['name'];
    if (isset($_POST['redirect'])) {
        header('location: ' . $_POST['redirect']);
    } else {
        header('location: index.php');
    }
} else {
    if (isset($_POST['redirect'])) {
        header('location: login.php?error=&redirect=' . urlencode($_POST['redirect']));
    } else {
        header('location: login.php?error=');
    }
}
