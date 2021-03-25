<?php

#region get-data
require_once '../config/database.php';
$table_name = "articles";

function getArticles($table, $connection) {
    $query = "SELECT id, title, content, image
              FROM ${table}";
    $stmt = $connection->prepare($query);
    $stmt->execute();
    return $stmt;
}

$stmt = getArticles($table_name, $db_default_connection);
$count = $stmt->rowCount();

$articles = [];

if ($count > 0) {
    while($article = $stmt->fetch(PDO::FETCH_ASSOC)) {

        extract($article);

        $article_obj = [
            "id" => $id,
            "title" => $title,
            "content" => $content,
            "image" => $image
        ];

        array_push($articles,  $article_obj);
    }
}
#endregion get-data
?>

<?php include "./article.php"; ?>

<!DOCTYPE html>
<html lang="fr">
<?php $title="BioBloc - List of articles"; require "../head.php"; ?>
<body>
    <?php require "../header.php" ?>
    <style>
        img { width: 100%; }
        .ql-video { max-width: 100%; }
    </style>
    <div class="container">
        <div class="row">
            <?php foreach($articles as $article): ?>
                <div class="col-md-4 mb-4">
                    <?= createArticle($article) ?>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <?php require "../footer.php" ?>
</body>
</html>
