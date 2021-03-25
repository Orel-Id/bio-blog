<?php
require '../vendor/autoload.php';

function createArticle($article) {
    // if (strpos($article['content'], '{') === 0) {
    //     $lexer = new \nadar\quill\Lexer(html_entity_decode('{"ops":[{"insert":"title 1"},{"attributes":{"header":1},"insert":"\n"},{"insert":"\nhelllooook\n\nthe title two"},{"attributes":{"header":2},"insert":"\n"},{"insert":"\nok ok\n"}]}'));
    //     $content = $lexer->render();
    // } else {
    //     $content = $article['content'];
    // }
    try {
        $quill = new \DBlackborough\Quill\Render(html_entity_decode($article['content']));
        $content = $quill->render();
    } catch (Exception $e) {
        // echo $e->getMessage();
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
