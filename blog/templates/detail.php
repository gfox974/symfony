<?php $titre = "Detail de l'article"; ?>

<?php ob_start() ?>

<h1> <?= $article['titre'] ?> </h1>
    
<div>
    Publié le : <?= $article['created'] ?> - par: <?= $article['auteur'] ?>
    <p> <?= $article['corps'] ?> </p>
</div>

<?php $contenu = ob_get_clean(); ?> 

<?php include 'layout.php'; ?> 