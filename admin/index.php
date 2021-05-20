<?php
    include "../debuger.php";
    session_start();
    $connected = isset($_SESSION['login']);

    // Les références:
    $test = ['1', '2', '3'];
    // - Manipulation direct -
    /*
        $test2 = array_push($test, '4');
        debug_var($test, $test2);
        $test => ['1', '2', '3', '4'];
    */

    // - Manipulation par copie -
    /*
        function addToArray($array, $toAdd) {
            array_push($array, $toAdd);
            return $array;
        }
        $test2 = addToArray($test, '4');
        $test => ['1', '2', '3'];
    */

    // - Manipulation par référence -
    /*
        function addToArray($array, $toAdd) {
            array_push($array, $toAdd);
            return $array;
        }
        $test2 = addToArray($test, '4');
        $test => ['1', '2', '3', '4'];
    */

    // Manipulations de dates
    $myDate = new DateTime('2021-05-20T16:20:50.646Z', new DateTimeZone('Europe/Brussels'));
    $modifiedDate = $myDate->modify('+2 hours')->modify('+5 minutes');
    $now = new DateTime(null, new DateTimeZone('Europe/Brussels')); // Date actuelle timezonée
    $utcNow = new DateTime(); // Date actuelle en UTC

    // debug_var($modifiedDate->format('d/m/Y H:i P'), $now, $utcNow);

    // Sauvegarder dans un cookie (moins de RAM utilisée par rapport à la sauvegarde en session)
    setcookie('lang', 'fr', ['secure' => true, 'path' => '/', 'httponly' => true]);
    // expires_or_options: exporation du cookie (0 = cookie de session)
    // path: path ayant accès au cookie (un cookie sauver sous /admin ne sera pas accessible sous /user par exemple mais /admin/user bien)
    // domain: domaine ayant accès au cookie (google.be sera accessible à manage.google.be mais pas à bob.be)
    // secure: uniquement utilisable en https si le flag est mis à true
    // $httponly: non accessible au javascript si le flag est mis à true

    // setcookie est une fonction équivalante à faire: header('Set-Cookie', 'lang=fr; path=/; secure; HttpOnly');
    // récupération du cookie précédement sauvé: echo $_COOKIE['lang'];

    if (!$connected) {
        header('location: ../login.php?redirect=' . urlencode('admin/index.php'));
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    <h1>Administration</h1>
    <a href="../index.php">Home</a>
</body>
</html>
