<?php

require_once '../../config/database.php';

function getArticles($connection) {
    $query = "SELECT id, title, content, image
              FROM articles";
    $stmt = $connection->prepare($query);
    $stmt->execute();
    return $stmt;
}

function getMappedArticles() {
    global $db_default_connection;
    $stmt = getArticles($db_default_connection);
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
    return $articles;
}
