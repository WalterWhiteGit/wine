<?php
/**
 * Created by PhpStorm.
 * User: samy
 * Date: 08/12/2017
 * Time: 21:34
 */

namespace AppBundle\Controller\shop;



use AppBundle\Entity\Products;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DetailsProductController extends Controller
{

    /*
     * show detail product
     */

    /**
     * @Route("/Shop/{slug}", name="shop.product",defaults={"slug" = null})
     */


    public function showProductAction (Request $request, $slug)
    {

        $doctrine = $this->getDoctrine();

        $results = $doctrine->getRepository(Products::class)->selectAllBySlug($slug);

        //exit(dump($results));

        return $this->render(':Shop:product.html.twig',['slug'=>$results]);

    }

}