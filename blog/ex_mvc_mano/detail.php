<?php
// V5 exo : ajouter une page faisant le detail de l'article


// modele
// tous les modeles des operations liées à la db sont reunies dans un seul fichier
require_once 'model_v5.php';

// controller
$article = getArticleByID($_GET['id']);

// vue
include 'templates/detail.php';
