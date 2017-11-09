<?php
/**
 * Created by PhpStorm.
 * User: samy
 * Date: 28/10/2017
 * Time: 23:51
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Contact;
use AppBundle\Event\ContactMailEvent;
use AppBundle\Event\ContactMailSendMail;
use AppBundle\Form\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class ContactController extends Controller
{

    /**
     * @Route("/contact", name="contact.contact")
     */


    public function contactAction(Request $request){


    // Instance Doctrine
    $doctrine =$this->getDoctrine();

    $em = $doctrine->getManager() ;

    // Select Entity
    $entity = new Contact();

    $entityType = ContactType::class;


    // Create Form

    $form = $this->createForm($entityType,$entity);

    $form->handleRequest($request);

    $createForm =$form->createView();


        // Submit form

            if ($form->isSubmitted() && $form->isValid() ){

                $data= $form->getData();


                //exit(dump($data));


                $mail = $data->getEmail();
                $firstname = $data->getFirstname();
                $content = $data->getContent();

                $em->persist($data);


        // Send to BDD
                $em->flush();

        // Confirm message
                $eventDispatcher = $this->get('event_dispatcher');

                //Instancier l'événement.
                $event = new ContactMailSendMail();


                $event->setEmail($mail);
                $event->setFirstname($firstname);
                $event->setContent($content);




                $message = 'Votre message a bien été envoyé';

                $this->addFlash('notice',$message);

                $eventDispatcher->dispatch(ContactMailEvent::Send_Mail_Contact,$event);

        // Redirect to homepage
                return $this->redirectToRoute('homepage.accueil');
            }


    // Return view
        return $this->render('contact/contact.html.twig',['form'=>$createForm]);
    }
}