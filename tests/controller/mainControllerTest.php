<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 06/02/2019
 * Time: 14:49
 */

namespace App\Tests;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class mainControllerTest extends WebTestCase
{
    /**
     *  @dataProvider urlProvider
     */
    public function testStatusCodePages($url, $expectedStatusCode)
    {
        $client = static::createClient();
        $client->followRedirects();

        $client->request('GET', $url);

        $this->assertEquals($expectedStatusCode, $client->getResponse()->getStatusCode());
    }

    public function urlProvider()
    {
        return array(
            array('/'. Post::URL_PAGE_POST .'/results', 200),
            array('/'. Post::URL_PAGE_POST , 200),
            array('/'. Post::URL_PAGE_POST .'/categorie/ufhdusfhdsuif', 404),
            array('/'. Post::URL_PAGE_POST .'/fhezfhzefhzef', 404),
            array('/', 200),
            array('/admin', 200),
            array('/contact', 200),
            array('/service', 200),
            array('/expertise', 200),
            array('/mentions-legales', 200),

        );
    }

}