<?php
// Version flat 2 :
// ( plus clean, sert de front controller )

$connexion = new PDO('mysql:host=localhost;dbname=blog;', 'root','');
$resultat = $connexion->query('SELECT id, titre FROM articles');


$articles = [];
while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)){
    $articles[] = $ligne;
}

$connexion = null;
include 'templates/liste.php';