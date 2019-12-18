<?php

namespace App\DataFixtures;

use App\Entity\Article;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Categorie;


class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        // on va peupler avec des articles de base

        $categories=['sport','art','musique','cuisine'];
        for($i=0;$i<sizeof($categories);$i++){
            $categorie = new Categorie();
            $categorie->setLibelle($categories[$i]);
            $manager->persist($categorie);
        
            for ($j=1; $j < mt_rand(2,5); $j++){
                $article = new Article();
                $article->setTitre('Titre article n°'.$j);
                $article->setCorps('Contenu de l\'article n°'.$j.' ... ');
                $article->setCreeLe(new DateTime());
                $article->setAuteur('Auteur de l\'article n°'.$j);
                $article->setCategorie($categorie);
                $manager->persist($article); // là on stocke l'objet
            }
        }
        $manager->flush();
    }
}
