<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class PostFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        $author = new User();
        $author->setUsername("test");
        $author->setEmail($faker->email);
        $author->setPassword("$2y$10\$sDoyH1TPI17M4tvXoPYmguw/dd34Wlq7lqgczYtwkWnimQTGMCRe6");
        $author->setEnabled(true);
        $manager->persist($author);

        for ($i = 1; $i < 10; $i++)
        {
            $post = new Post();
            $post->setTitle($faker->sentence($nbWords = 6, $variableNbWords = true));
            $post->setMetaDescription($faker->sentence($nbWords = 12, $variableNbWords = true));
            $post->setContent($faker->paragraph($nbSentences = 10));
            $post->setCreatedAt($faker->dateTime($max = 'now', Post::DATE_TIME_ZONE));
            $post->setImage("test_img.jpg");

            $category = new Category();
            $category->setName($faker->word);
            $manager->persist($category);

            $post->addCategory($category);

            $author = new User();
            $author->setUsername($faker->firstName($gender = null));
            $author->setEmail($faker->email);
            $author->setPassword($faker->word);
            $manager->persist($author);

            $post->setAuthor($author);

            $post->setPublished(true);

            $manager->persist($post);
        }


        $manager->flush();
    }
}
