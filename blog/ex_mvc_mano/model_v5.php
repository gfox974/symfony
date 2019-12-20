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

// voir phpdelusions pour les differentes requetes preps de pdo
function getArticleById($id){
    $connexion = open_database_connexion();
    $query = 'SELECT * FROM articles WHERE id=:id';
    $statement = $connexion->prepare($query); // on prepare pour avoir un objet statement
    $statement->bindValue('id',$id, PDO::PARAM_INT); // la valeur id doit etre de type integer
    $statement->execute();
    $article = $statement->fetch(PDO::FETCH_ASSOC); // on balance le fetching de la requete preparée 
    close_database_connexion($connexion);
    return $article;
}

?>