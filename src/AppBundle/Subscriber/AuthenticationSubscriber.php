<?php
/**
 * Created by PhpStorm.
 * User: samy
 * Date: 30/12/2017
 * Time: 00:19
 */

namespace AppBundle\Subscriber;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\AuthenticationEvents;
use Symfony\Component\Security\Core\Event\AuthenticationEvent;

class AuthenticationSubscriber implements EventSubscriberInterface
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;

    }

    public static function getSubscribedEvents()
    {
            // TODO: Implement getSubscribedEvents() method.

        return [ AuthenticationEvents::AUTHENTICATION_FAILURE=>'authenticationFailure'];

    }

// Echec authentication


    public function authenticationFailure(AuthenticationEvent $event)
    {

        /*
          Si la clé existe on récupére sa valeur, puis on l'implémente de 1 à
          chaque nouvelle tentative de connexion.
          Si la clé n'existe pas donc pas de tentative de connexion ou l'initialise
          à 1.
          Le nombre d'essai est paramétré à 3 depuis le fichier config.

         */
        if($this->session->has('nb_failure')){

            $value = $this->session->get('nb_failure');

            $value += 1;

            $this->session->set('nb_failure',$value);

        }

        else {

            $this->session->set('nb_failure',1);

        }
    }

}