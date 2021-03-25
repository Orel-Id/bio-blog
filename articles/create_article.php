
<?php
require_once '../config/database.php';

#region post-logic
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function test_quill_input($data) {
    $data = trim($data);
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
        'content' => test_quill_input($_POST['content'])
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
#endregion post-logic
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
                </label>
                <input type="hidden" name="content" />
                <div id="editor"></div>
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
        var quill = new Quill('#editor', {
            theme: 'snow',
            placeholder: 'Write your epic article',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    ['link'],
                    [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                    ['image', 'video'],
                    ['clean']
                ]
            }
        });
        var form = document.querySelector('form');
        form.onsubmit = function() {
            var contentInput = document.querySelector('input[name=content]');
            var content = quill.getContents();
            console.log('submit', content);
            if (content.ops.length === 1 && Object.keys(content.ops[0]).length === 1 && content.ops[0].insert.trim().length === 0) {
                document.querySelector('#editor').className="ql-container ql-snow -error";
                return false;
            } else {
                document.querySelector('#editor').className="ql-container ql-snow";
                contentInput.value = JSON.stringify(content);
                return true;
            }
        };
        quill.setContents(<?= isset($article) ? $article['content'] : '' ?>);
    </script>
</body>
</html>
