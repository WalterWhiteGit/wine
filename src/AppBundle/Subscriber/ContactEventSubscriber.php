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
    private $twig;



    public function __construct(ManagerRegistry $doctrine, \Swift_Mailer $mailer,\Twig_Environment $twig)
    {

        $this->mailer=$mailer;
        $this->doctrine=$doctrine;
        $this->twig=$twig;

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
        $reason = $event->getObject();


        switch ($reason){


            case "RES":

                $reason = "de réservations";

                break;


            case "INF":

                $reason = "d'informations";

                break;

            case "REC":

                $reason = "de réclamations";

                break;

        }


        //
        $sendmail = (new \Swift_Message())

                ->setFrom('customer-contact@gmail.com')
                ->setSubject($firstname.', votre demande est prise en compte')
                ->setTo($mail)
                ->setContentType('text/html')
                ->setBody($this->twig->render('MailTemplate/confirm.html.twig',

                    ['email'=>$mail, 'firstname'=>$firstname,'reason'=>$reason]

                    ))

                ->addPart($this->twig->render('MailTemplate/confirm.html.twig',

                    ['email'=>$mail, 'firstname'=>$firstname, 'reason'=>$reason]),'text/plain');


        // Send mail
        $this->mailer->send($sendmail);


    }

}