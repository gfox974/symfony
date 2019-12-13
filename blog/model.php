<?php

function open_database_connexion(){
    $connexion = new PDO('mysql:host=localhost;dbname=blog;', 'root','');
    return $connexion;
}

function close_database_connexion(&$connexion){ // on ajoute un handler pour passer un pointeur vers une ressource ( & )
    $connexion = null;
}

function getArticles(){
    $connexion = open_database_connexion();
    $resultat = $connexion->query('SELECT id, titre FROM articles');

    $articles = [];
    while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)){
        $articles[] = $ligne;
    }
    close_database_connexion($connexion);
    return $articles;
}

?>