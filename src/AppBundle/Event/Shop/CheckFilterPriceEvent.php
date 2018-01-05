<?php
/**
 * Created by PhpStorm.
 * User: samy
 * Date: 02/01/2018
 * Time: 11:02
 */

namespace AppBundle\Event\Shop;


use Symfony\Component\EventDispatcher\Event;

class CheckFilterPriceEvent extends Event
{

    private $price;

    private $operator;

    /**
     * @return mixed
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * @param string $operator
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;
    }



    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $this->controlPrice($price);
    }




    public function controlPrice ($price){


    $sizeFilter= count($price);

    if($sizeFilter === 1) {

        switch ($price[0]) {

            case 1 :

                $price = 30;

                $operation = '<=';

                $this->setOperator($operation);


                break;

            case 2 :

                $price = [30,50];

                break;

            case 3 :

                 $price = [50,100];

                 break;

            case 4 :

                $price = 100;

                $operation = '>=';
                $this->setOperator($operation);

                break;
            }

            return $price;



    }

    elseif ($sizeFilter === 2){

        if(in_array(1,$price) && in_array(4,$price)){

            $price = [30,100];

            return $price;

        }

    }







    }


}