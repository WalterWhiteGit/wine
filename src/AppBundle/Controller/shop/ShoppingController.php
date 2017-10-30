<?php
/**
 * Created by PhpStorm.
 * User: samy
 * Date: 28/10/2017
 * Time: 22:58
 */

namespace AppBundle\Controller\shop;



use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShoppingController extends Controller
{

    /**
     *
     * @Route("/Shopping", name="shop.shopping")
     *
     */


    public function shoppingController(){


        return $this->render('shop/shopping.html.twig');
    }
}