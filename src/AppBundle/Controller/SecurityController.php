<?php
/**
 * Created by PhpStorm.
 * User: samy
 * Date: 28/12/2017
 * Time: 12:08
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;




/**
 *
 * @Route("/user")
 */
class SecurityController extends Controller
{


/*
 * Connexion limitée à 3 tentatives.
 */

    /**
     * @Route("/login/", name="app.security.login")
     */


    public function loginAction (Request $request, AuthenticationUtils $utils){

        // Récupérer la séssion

        $session = $request->getSession();


        // Récupérer les paramétres de configuration
        $maxFailureAuthentication = $this->getParameter('max_failures_authentication');

        // Tester le nombre d'échec de connexion et rediriger vers la page d'oubli de connexion
        if($session->get('nb_failure')=== $maxFailureAuthentication){


            $message = 'Vous semblez avoir oublié votre mot de passe';
            $this->addFlash('notice',$message);
            ($session->remove('nb_failure'));
            return $this->redirectToRoute('app.account.forgot-password');

            }


        // Récupérer erreur de log.
        $error = $utils->getLastAuthenticationError();

        // Récupérer l'user
        $lastUsername = $utils->getLastUsername();

        $tryNumber = $session->get('nb_failure');


        return $this->render(':security:login.html.twig',[
            'last_username'=>$lastUsername,
            'error'=>$error,
            'essai'=>$tryNumber,
            'nbessai'=>$maxFailureAuthentication
        ]);

    }

/*
Déconnexion
*/

    /**
     * @Route("/logout", name="app.security.logout")
     *
     */

    public function logoutAction(Request $request, AuthenticationUtils $Utils){

    }


/*
 *
 * On redirige selon le profil vers la page relative à ce dernier.
 *
 */

    /**
     * @Route("/redirect", name="app.security.redirect")
     *
     */

    public function redirectAction(Request $request)
    {

        $user = $this->getUser();




       //exit(dump($user->getUsername()));

        if (in_array('ROLE_ADMIN', $user->getRoles())) {


            return $this->redirectToRoute('app.admin.homepage');
        }
    }

}