<?php

namespace AppBundle\Controller;



use AppBundle\Entity\Products;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomePageController extends Controller
{
    /**
     * @Route("/", name="homepage.accueil")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need


        $doctrine = $this->getDoctrine();

        //$results = $doctrine->getRepository()


        return $this->render('homepage/accueil.html.twig');
    }
}
