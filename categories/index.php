<?php

session_start();

if (isset($_POST["delete"])) {
    
    function filter_category($category)
    {
        $id = $_POST["id"];
        return $id !== strval($category["id"]);
    }

    $_SESSION['categories'] = array_filter($_SESSION['categories'], "filter_category");
}

if (isset($_POST["create"])) {
    $latest = end($_SESSION['categories']);

    if ($latest) {
        $elem = ["id" => $latest["id"] + 1, "name" => $_POST["name"]];
        array_push(
            $_SESSION['categories'],
            $elem
        );
    } else {
        $_SESSION['categories'] = [
            ["id" => 1, "name" => $_POST["name"]]
        ];
    }
}

if (isset($_POST["save"])) {
    foreach($_SESSION['categories'] as $key => $category) {
        if ($category["id" ]) {
            $_SESSION['categories'][$key]["name"] =  $_POST["name"];
            break;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<?php $title="BioBloc - Categories"; require "../head.php"; ?>
<body>
    <?php require "../header.php" ?>
    <div class="container">
        <h1>Catégories</h1>
        <?php foreach ($_SESSION['categories'] as $category): ?>
            <form class="card mb-4" method="POST" action="./index.php">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-10 mb-0">
                            <input type="hidden" name="id" value="<?= $category["id"] ?>" />
                            <input type="text" class="form-control" name="name" placeholder="Entrez un nom de catégorie" value="<?= $category["name"] ?>" />
                        </div>
                        <div class="col-2">
                            <input type="submit" value="Save" name="save" class="btn btn-primary" />
                            <input type="submit" value="Delete" name="delete" class="btn btn-danger" />
                        </div>
                    </div>
                </div>
            </form>
        <?php endforeach ?>

        <form class="card mt-5" method="POST" action="./index.php">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-11 mb-0">
                        <input type="text" class="form-control" name="name" placeholder="Entrez un nom de catégorie" required />
                    </div>
                    <div class="col-1">
                        <input type="submit" value="Créer" name="create" class="btn btn-success" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require "../footer.php" ?>
</body>
</html>
