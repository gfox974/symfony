<?php

function liste_action(){
    $articles = getArticles();
    require 'templates/liste.php';
}

function detail_action($id){
    $article = getArticleById($id);
    require 'templates/detail.php';
}

?>