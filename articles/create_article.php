
<?php
require_once '../config/database.php';

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function validateInputs($inputs) {
    $errors = [];
    if (empty($inputs['title'])) {
        $errors['title'] = 'Title is required';
    }
    if (empty($inputs['content'])) {
        $errors['content'] = 'Content is required';
    }
    return $errors;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validations = validateInputs($_POST);

    $article = [
        'title' => test_input($_POST['title']),
        'content' => $_POST['content'] // test_input()
    ];

    if (sizeof($validations) === 0) {

        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

        $article['image'] = $target_file;

        function prepareInsertArticle($connection) {
            $query = "INSERT INTO articles(title, content, creationdate, image) VALUES(:title, :content, now(), :image)";
            $stmt = $connection->prepare($query);
            return $stmt;
        }
        
        function executeInsertArticle($stmt, $article) {
            $stmt->execute($article);
        }
        
        try {
            $stmt = prepareInsertArticle($db_default_connection);
            executeInsertArticle($stmt, $article);
            header('location: get_articles.php');
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }
    }
    
}
?>

<!DOCTYPE html>
<html lang="fr">
<?php $title="BioBloc - New article"; require "../head.php"; ?>
<body>
    <?php require "../header.php" ?>
    <div class="container">
        <h1>New article</h1>

        <form
            action="create_article.php"
            method="POST"
            class="<?= isset($validations) ? 'was-validated' : '' ?>"
            enctype="multipart/form-data"
        >

            <div class="form-group">
                <label>Title
                    <input class="form-control" type="text" name="title" placeholder="Title" maxlength="50" required value="<?= isset($article) ? $article['title'] : '' ?>" />
                </label>
                <?php if(isset($validations) && isset($validations['title'])): ?>
                    <p><?= $validations['title'] ?></p>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label>Content
                    <!-- <textarea class="form-control" name="content" maxlength="1000" required><?= isset($article) ? $article['content'] : '' ?></textarea> -->
                    <input type="hidden" name="content"/>
                </label>
                <div id="editor">
                </div>
                <?php if(isset($validations) && isset($validations['content'])): ?>
                    <p><?= $validations['content'] ?></p>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="formFile" class="form-label">Image</label>
                <input class="form-control" type="file" id="image" name="image">
            </div>

            <input type="submit" value="Save" class="btn btn-primary" />

            <?php if (isset($article)): ?>
                <p>Error !</p>
            <?php endif ?>

        </form>
    </div>
    <?php require "../footer.php" ?>
    <script>
        const quill = new Quill('#editor', {
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    ['link'],
                    [{ 'script': 'sub'}, { 'script': 'super' }],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['image', 'video'],
                    ['clean']
                ]
            },
            placeholder: 'Write an epic article',
            theme: 'snow'
        });

        const form = document.querySelector('form');
        form.onsubmit = function() {
            const content = document.querySelector('input[name=content]');
            content.value = JSON.stringify(quill.getContents());
            return true;
        };
        quill.setContents(<?= isset($article) ? html_entity_decode($article['content']) : '' ?>);
    </script>
</body>
</html>