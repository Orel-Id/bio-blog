<?php include "./article.php"; ?>

<!DOCTYPE html>
<html lang="fr">
<?php $title="BioBloc - List of articles"; require "../../head.php"; ?>
<body>
    <?php require "../../header.php" ?>
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
    <?php require "../../footer.php" ?>
</body>
</html>
