<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 10/02/2019
 * Time: 16:46
 */

namespace App\Tests\Service;


use App\Entity\Contact;
use App\Service\ContactNotification;
use PHPUnit\Framework\TestCase;
use Swift_Mailer;
use Twig_Environment;

class ContactNotificationTest extends TestCase
{
    private $mailer;
    private $twig;

    public function setUp()
    {
        $this->mailer = $this
            ->getMockBuilder(Swift_Mailer::class)
            ->disableOriginalConstructor()
            ->setMethods(['send'])
            ->getMock();
        $this->twig = $this
            ->getMockBuilder(Twig_Environment::class)
            ->disableOriginalConstructor()
            ->setMethods(['render'])
            ->getMock();
    }
    public function testNotify()
    {
        $contact = new Contact();
        $contactNotification = new ContactNotification($this->mailer, $this->twig);

        $this->mailer
            ->expects($this->once())
            ->method('send')
            ->willReturn(1);

        $result = $contactNotification->notify($contact);
        $this->assertSame(1, $result);
    }

}