<?php
/**
 * Created by PhpStorm.
 * User: samy
 * Date: 05/01/2018
 * Time: 16:02
 */

namespace AppBundle\Controller\Account;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/user")
 *
 */

class PasswordForgottenController extends Controller
{

    /**
     *
     * @Route("/mot-de-passe-oublié", name="app.account.forgot-password")
     *
     */

    public function passwordforgottenAction(Request $request){



        return $this->render(':account:password.forgotten.html.twig');

    }


}