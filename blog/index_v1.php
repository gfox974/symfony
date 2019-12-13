<?php
// Version flat :
// ( hardcore a maintenir, peu modulable )

$connexion = new PDO('mysql:host=localhost;dbname=blog;', 'root','');
$resultat = $connexion->query('SELECT id, titre FROM articles');

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog</title>
</head>
<body>
    <h1> Liste des articles </h1>
    <ul>
        <?php while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)): ?>
            <li><a href="detail.php?id=<?= $ligne['id'] ?>"></a> <?=$ligne['titre'] ?></a> </li>
        <?php endwhile ?>
    </ul>
</body>
</html>
<?php
$connexion = null;
?>