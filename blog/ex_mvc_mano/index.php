<?php
// Version 3 - 4 :
// V4 on passe par un layout isolé ( liste.php master view donc) où on injecte le contenu
// V5 exo : ajouter une page faisant le detail de l'article
// V6 : routing

// modele
// tous les modeles des operations liées à la db sont reunies dans un seul fichier
require_once 'model_v5.php';
// on va en faire un front controller
require_once 'controllers.php';

// table de routing a l'arrache :
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// print_r($uri);
// si match pattern -> action du controller
if ($uri == '/blog/') {
    liste_action();
} elseif ($uri == '/blog/index.php/detail' && isset($_GET['id'])) {
    detail_action($_GET['id']);
} else {
    header('HTTP/1.1 404 Not Found');
    echo '<html><body> 404 </body></html>';
}

// vue
// include 'templates/liste.php';