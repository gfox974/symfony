<?php
// Version 3 - 4 :
// V4 on passe par un layout isolé ( liste.php master view donc) où on injecte le contenu
// V5 exo : ajouter une page faisant le detail de l'article


// modele
// tous les modeles des operations liées à la db sont reunies dans un seul fichier
require_once 'model.php';

// controller
$articles = getArticles();

// vue
include 'templates/liste.php';