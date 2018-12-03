<?php

namespace App\DataFixtures;

use App\Entity\Page;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PageFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i < 10; $i++)
        {
            $page = new Page();
            $page->setTitle("Titre de la page");
            $page->setContent("Contenu de la page");
            $page->setCreatedAt(new \DateTime());

            $manager->persist($page);
        }


        $manager->flush();
    }
}
