<?php $titre = "liste des articles"; ?>

<?php ob_start() ?> <!-- Capture du bloc  sous forme de chaine de caracteres apres le start pour l'injecter dans une variable -->

<h1> Liste des articles </h1>
    <ul>
        <?php foreach($articles as $article): ?>
           <!-- pré-v6 <li><a href="/blog/detail.php?id=<?= $article['id'] ?>"></a> <?=$article['titre'] ?></a> </li> -->
           <li><a href="/blog/index.php/detail?id=<?= $article['id'] ?>"> <?=$article['titre'] ?></a> </li>
        <?php endforeach ?>
    </ul>

<?php $contenu = ob_get_clean(); ?> <!-- affectation du buffer dans la variable contenu -->

<?php include 'layout.php'; ?> <!-- On passe l'include en fin comme ca les variables ont été process avant d'etre injectées -->