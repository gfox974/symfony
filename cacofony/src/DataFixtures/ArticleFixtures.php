<?php

namespace App\DataFixtures;

use App\Entity\Article;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        // on va peupler avec des articles de base
        for ($i=1; $i < 10; $i++){
            $article = new Article();
            $article->setTitre('Titre article n°'.$i);
            $article->setCorps('Contenu de l\'article n°'.$i.' ... ');
            $article->setCreeLe(new DateTime());
            $article->setAuteur('Auteur de l\'article n°'.$i);
            $manager->persist($article); // là on stocke l'objet
        }

        $manager->flush();
    }
}
