<?php
/**
 * Created by PhpStorm.
 * User: samy
 * Date: 03/11/2017
 * Time: 23:14
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\AreaProducts;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AreaFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {

        $AreaWine = ['Bourgogne','Pays de la Loire','Chianti','Ribera del Duero',
                     'Rioja','Bordeaux','Toscane'];


        $countAera = count($AreaWine);

        $entity = new AreaProducts();

        for($i=0; $i < $countAera ;$i ++) {

            $entity->setArea($AreaWine[$i]);

            $manager->persist($entity);

        }


            $manager->flush();

    }

}