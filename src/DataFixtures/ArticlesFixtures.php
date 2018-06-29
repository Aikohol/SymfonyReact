<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Articles;

class ArticlesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i < 10; $i++) {
			$article = new Articles();
			$article->setName("Nom de l'article $i")
					->setContent("<p>Contentu de l'articles n$i</p>")
					->setImage("http://placehold.it/350x150")
					->setCreatedAt(new \DateTime());
			$manager->persist($article);
		}

        $manager->flush();
    }
}
