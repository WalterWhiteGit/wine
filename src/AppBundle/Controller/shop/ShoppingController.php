<?php
/**
 * Created by PhpStorm.
 * User: samy
 * Date: 28/10/2017
 * Time: 22:58
 */

namespace AppBundle\Controller\shop;



use AppBundle\Entity\Products;
use AppBundle\Entity\WineArea;
use AppBundle\Entity\Winetype;
use AppBundle\Form\ProductsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ShoppingController extends Controller
{




    /**
     *
     * @Route("/Shopping", name="shop.shopping")
     *
     */


    public function shoppingController(){

        $doctrine = $this->getDoctrine();

        $product = $doctrine->getRepository(Products::class);

        //$area = $doctrine->getRepository(Products::class)->selectQtyByType();

        $year = $product->findYear();

        $countproduct = $doctrine->getRepository(Products::class)->countProducts();

        $count = $countproduct;

        $date = date('d/m/Y');


        return $this->render(':Shop:shopping.html.twig', ['year'=>$year,'date'=>$date]);
    }


    /**
     *
     * @Route("/shopwine", name="shop.shopping.shopwine")
     *
     */




    public function shopwine(Request $request){


        $firstresults = 0;
        $maxresults = 10;


        $doctrine= $this->getDoctrine();

        $result = $doctrine->getRepository(Products::class)->selectAll($firstresults,$maxresults);



        return new jsonResponse($result);

    }

    /**
     * @Route("/ajax", name="shop.shopping.ajax")
     *
     */


    public function ajaxAction(Request $request)
    {


        $name =$request->request->get('data');

        $get= $this->getDoctrine();

        $results = $get->getRepository(Products::class)->searchProducts($name);


        //Retour ce fait en JSON

        return new JsonResponse($results);

    }


    /**
     * @Route("/aera", name="shop.shopping.aera")
     *
     */

    public function aeraAction(Request $request)
    {
        $get = $this->getDoctrine();


        if($request->get('data')) {

                if($request->get('type')){

                    $wineaera = $request->request->get('data');
                    $winetype = $request->request->get('type');

                    $results= $get->getRepository(Products::class)->displayByAeraType($winetype,$wineaera);
                }

                else {

                    $aera = $request->request->get('data');

                    $results = $get->getRepository(Products::class)->searchAera($aera);
                }
            }

        elseif ($request->get('aera')){

            $aera = $request->request->get('aera');

            $results = $get->getRepository(Products::class)->filterAera($aera);

        }


        elseif($request->get('type')){

            $winetype = $request->request->get('type');

            $results = $get->getRepository(Products::class)->displayAreaBytype($winetype);

        }

        else{

            $results = $get->getRepository(Products::class)->displayAera();

        }

        //Retour ce fait en JSON

        return new JsonResponse($results);

    }



    // by country

    /**
     *
     * @Route ("/pays", name="shop.shopping.vins-par-pays")
     *
     */

    public function countryAction (Request $request)
    {
        $get = $this->getDoctrine();

        if($request->get('data')) {
            $choice = $request->request->get('data');


            $country = $get->getRepository(Products::class)->searchCountry($choice);

            return new JsonResponse($country);

        }

        else {

            $country= $get->getRepository(Products::class)->findCountry();

            return new JsonResponse($country);


        }
    }


    /**
     * @Route("/type", name="shop.shopping.vins-par-type")
     */

    public function findByTypeAction(Request $request){

        $doctrine = $this->getDoctrine();
        $repository = $doctrine->getRepository(Products::class);

        if ($request->get('country')){

        $winecountry = $request->request->get('country');
        $winetype = $request->request->get('type');

        $type= $repository->displayTypeByCountry($winetype,$winecountry);


        return new JsonResponse($type);

        }


        elseif($request->get('type')){

            $winetype = $request->request->get('type');

            $type = $repository->displayByType($winetype);

            return new JsonResponse($type);
        }

// Récupérer les types de vin par régions

        elseif ($request->get('area')){


            $winetype = $request->request->get('area');


            $type = $repository->displayTypeByArea($winetype);

            return new JsonResponse($type);

        }

        else {

            $repository = $doctrine->getRepository(Winetype::class);
            $type = $repository->findType();

            return new JsonResponse($type);

        }
    }


    /**
     *
     * @Route("/price", name="shop.shopping.byprice")
     *
     */

    public function findByPrice (Request $request)
    {
            $doctrine = $this->getDoctrine();

            $data = $request->request->get('price');

            // Tester la taille du tableau si est égale
            if (in_array(1, $data) && in_array(3,$data)) {

                //exit(dump('valeur trouvée'));
            }

            else{

                //exit(dump('pas de valeur'));
            }

            if ($data[0] == 1) {

                $price = 30;

                $findprice = $doctrine->getRepository(Products::class)->displayByPrice($price);

                return new JsonResponse($findprice);

            }

            elseif ($data[0]== 2){

                $price = [30,50];

                $findprice = $doctrine->getRepository(Products::class)->displayByPriceRange($price);

                return new JsonResponse($findprice);


            }

            else{

            }


    }



}