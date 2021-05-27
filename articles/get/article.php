<?php
require '../../vendor/autoload.php';

function createArticle($article) {

    try {
        $quill = new \DBlackborough\Quill\Render($article['content']);
        $content = $quill->render();
    } catch (Exception $e) {
        $content = $article['content'];
    }

    return "
        <article class=\"card\" style=\"width: 100%;\">
            <img src=\"{$article['image']}\" class=\"card-img-top\" alt=\"...\">
            <div class=\"card-body\">
                <h5 class=\"card-title\">{$article['title']}</h5>
                <p class=\"card-text\">{$content}</p>
                <a href=\"#\" class=\"btn btn-primary\">Read</a>
            </div>
        </article>
    ";
}
