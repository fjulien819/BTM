<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 22/01/2019
 * Time: 10:41
 */

namespace App\Service;


use App\Entity\Contact;
use Twig\Environment;

class ContactNotification
{

    const NOTIFICATION_EMAIL_DELIVERY = "fjulien819@gmail.com";

    private $mailer;

    private $renderer;

    /**
     * ContactNotification constructor.
     * @param \Swift_Mailer $mailer
     * @param Environment $renderer
     */
    public function __construct(\Swift_Mailer $mailer, Environment $renderer)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }

    /**
     * @param Contact $contact
     * @return int
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function notify(Contact $contact)
    {
        $message = (new \Swift_Message($contact->getObject()))
            ->setFrom("noreply@BackToMobile.fr")
            ->setTo(ContactNotification::NOTIFICATION_EMAIL_DELIVERY)
            ->setReplyTo($contact->getEmail())
            ->setBody($this->renderer->render('emails/contact_notification.html.twig', [
                'message' => $contact->getMessage(),
                'prenom' => $contact->getName(),
                'nom' => $contact->getLastName()

            ]), 'text/html');

        return  $this->mailer->send($message);
    }
}