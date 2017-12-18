<?php
/**
 * Created by PhpStorm.
 * User: samy
 * Date: 31/10/2017
 * Time: 15:49
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Products;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProductsFixtures extends Fixture
{

    public function load (ObjectManager $manager)
    {


        $productsName = ['Aloxe-Corton','MonteCito','Rioja Reserva','Vallée des vignes','Côte de Beaune',
                         'Chianti Classico', 'Priorat Bodega','Nuits-Saints-Georges','Casa Milagri','Gevrey-Chambertin',
                         'Les Grands Chaillots','Clos du Château','Château Clos de Vaulichères','Crémant chardonnay',
                         'Marchese Antinori Riserva','Barone Ricasoli','Badia a Passignano','CAPA SINGLE VINEYARD',
                         'CIMS DEL MONTSANT','PERSEVERANCE CRIANZA','RIBEIRA DEL DUERO'];


        $productsSlug = ['Aloxe-Corton','MonteCito','Rioja-Reserva','Vallée-des-vignes', 'Cote-de-Beaune',
                         'Chianti-Classico', 'Priorat-Bodega','Nuits-Saints-Georges','Casa-Milagri','Gevrey-Chambertin',
                         'Les-Grands-Chaillots','Clos-du-Château','Château-Clos-de-Vaulichères','Crémant-chardonnay',
                         'Marchese-Antinori-Riserva','Barone-Ricasoli','Badia-a-Passignano','CAPA-SINGLE-VINEYARD',
                         'CIMS-DEL-MONTSANT','PERSEVERANCE-CRIANZA','RIBEIRA-DEL-DUERO'];



        $productVendor = ['Vendor1','Vendor2','Vendor3','vendor4'];

        $productDescription = ['un vin au nez franc, sur les fruits mûrs qui laisse s’échapper des notes d’épices.
                                Cette cuvée de pinot noir offre une bouche ronde, sur des tanins doux, qui reprend en
                                finale les arômes épicés. Un magnum complet, savoureux et élégant, belle illustration du
                                style de cette propriété gérée en biodynamie.',
                                'Un superbe vin tout en fruit. Superbes arômes de prune et de cerise avec 
                                 quelques notes végétales. Dense avec des tanins très fins et une bouche soyeuse.',
                                'Le Blason de L’Evangile, choisi à partir de cuves ayant les mêmes bases que le premier
                                vin, présente des caractéristiques proches de ce grand vin avec cependant un potentiel
                                de garde moindre puisque son élevage en barrique est plus court. Cet assemblage
                                de Merlot et de Cabernet Franc s\'exprimera mieux en étant décanté pendant une heure.'
                                ];

        $productImg = ['AlbertBichotMercurey','BourgogneEpineuil','ChâteauLamotheBouscaut','ChâteauTourdesTermes',
                        'DomainedelaFramboisiere','Gewurztraminer_Collection_2016','LesTourellesdeLongueville'];


        $buyPrice = [12.99,9.99,14.70,21.55];

        $salePrice = [27.99,19.99,34,54.90];

        $countName = count($productsName);





        for ($i = 0; $i < $countName ;$i ++){

            //exit(dump($countName));

            $entity = new Products();

            $vendor = count($productVendor);
            $description = count($productDescription);
            $image = count($productImg);
            $price = count($buyPrice);
            $sale = count($salePrice);

            // On charge nos tables
            $entity->setProductCode(mt_rand(1000,5000));
            $entity->setProductName($productsName[$i]);
            $entity->setProductVendor($productVendor[mt_rand(0,$vendor-1)]);
            $entity->setProductDescription($productDescription[mt_rand(0,$description-1)]);
            $entity->setQuantityInStock(mt_rand(1,21));
            $entity->setBuyPrice($buyPrice[mt_rand(0,$price-1)]);
            $entity->setSalePrice($salePrice[mt_rand(0,$sale-1)]);
            $entity->setSlug($productsSlug[$i]);
            $entity->setProductImage($productImg[mt_rand(0,$image-1)]);
            $entity->setYear(mt_rand(2002,2015));




            // On stocke les données.
            $manager->persist($entity);

            //exit(dump($manager));
        }

            // On délivre les données.
            $manager->flush();

    }



}