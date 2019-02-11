<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 10/02/2019
 * Time: 17:04
 */

namespace App\Tests\Controller;


use App\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Faker;

class mainControllerTest extends WebTestCase
{

    public function testContactform()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/contact');

        $buttonCrawlerNode = $crawler->selectButton('envoyer');
        $form = $buttonCrawlerNode->form();

        $faker = Faker\Factory::create();

        $name = $faker->name();
        $lastName = $faker->lastName();
        $email = $faker->email();
        $object = $faker->randomElements($array = array (Contact::OBJECT_INFO_CHOICE, Contact::OBJECT_QUOTE_CHOICE,Contact::OBJECT_OTHER_CHOICE), $count = 1);
        $messageContent = $faker->text();

        $form['contact[name]'] = $name;
        $form['contact[lastName]'] = $lastName;
        $form['contact[email]'] = $email;
        $form['contact[object]'] = $object[0];
        $form['contact[message]'] = $messageContent;
        $form['contact[rgpd]'] = true;

        $client->enableProfiler();

        $crawler = $client->submit($form);

        $mailCollector = $client->getProfile()->getCollector('swiftmailer');

        $this->assertSame(1, $mailCollector->getMessageCount());


    }

}