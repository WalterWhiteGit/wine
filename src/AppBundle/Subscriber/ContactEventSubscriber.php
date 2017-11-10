<?php
/**
 * Created by PhpStorm.
 * User: samy
 * Date: 06/11/2017
 * Time: 12:04
 */

namespace AppBundle\Subscriber;


use AppBundle\Event\ContactMailEvent;
use AppBundle\Event\ContactMailSendMail;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ContactEventSubscriber implements EventSubscriberInterface
{


    private $mailer;
    private $doctrine;



    public function __construct(ManagerRegistry $doctrine, \Swift_Mailer $mailer)
    {

        $this->mailer=$mailer;
        $this->doctrine=$doctrine;

    }

    public static function getSubscribedEvents()
    {
        // Call Event from AppBundle\Event
        return [ContactMailEvent::Send_Mail_Contact=>'sendContactMail'];

    }


    public function sendContactMail(ContactMailSendMail $event, $mailer)
    {

        // Get variables

        $mail = $event->getEmail();
        $firstname = $event->getFirstname();
        $content = $event->getContent();



        //
        $sendmail = (new \Swift_Message())

                ->setFrom('customer-contact@gmail.com')
                ->setSubject('Demande de contact de '.$firstname)
                ->setTo($mail)
                ->setContentType('Text/Html')
                ->setBody($content);




        // Send mail
        $this->mailer->send($sendmail);


    }

}