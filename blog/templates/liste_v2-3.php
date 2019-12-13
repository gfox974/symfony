<!--- partie presentation (view), oui on aborde le mvc .. fichier concernant la conception v2 / v3 -->

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
        <?php foreach($articles as $article): ?>
            <li><a href="detail.php?id=<?= $article['id'] ?>"></a> <?=$article['titre'] ?></a> </li>
        <?php endforeach ?>
    </ul>
</body>
</html>
