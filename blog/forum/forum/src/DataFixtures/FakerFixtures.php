<?php
// src/DataFixtures/FakerFixtures.php
namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Thread;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use DateTime;

class FakerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // On configure dans quelles langues nous voulons nos données
        $faker = Faker\Factory::create('fr_FR');

        // on créé 10 auteurs
        for ($i = 0; $i < 10; $i++) {
            $author = new Author();
            $author->setName($faker->name);
            $author->setEmail($faker->email);
            $author->setPassword($faker->password);
            $author->setCreatedAt(new DateTime());
            $manager->persist($author);
        }
        $manager->flush();
    }
}