<?php
/**
 * Created by PhpStorm.
 * User: samy
 * Date: 09/01/2018
 * Time: 19:08
 */

namespace AppBundle\Controller\Admin\AdminProducts;


use AppBundle\Entity\Products;
use AppBundle\Form\ProductsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class AdminProductsController extends Controller
{
    /**
     *
     * @Route("/ajouter-produit", name="app.add.product")
     *
     */

    public function addProductAction (Request $request)
    {

        //Instance Doctrine

        $doctrine = $this->getDoctrine();

        $em= $doctrine->getManager();

        $entity= new Products();

        $entityType = ProductsType::class;

        // Création du formulaire

        $form = $this->createForm($entityType,$entity);

        $form->handleRequest($request);

        $createForm = $form->createView();


        //Controler le formulaire

        if($form->isSubmitted() && $form->isValid() ){


            $data = $form->getData();
            $productName = $data->getproductName();

            $em->persist($data);

            $em->flush();


            // (en cours de dév) Gestionnaire d'évenements Doctrine afin de traiter l'upload de l'image



        }



        return $this->render('admin/adminproducts/product.management.html.twig',
            ['form'=>$createForm]);


    }

}