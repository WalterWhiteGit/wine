<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Products
 *
 * @ORM\Table(name="products")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductsRepository")
 */
class Products
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="productCode", type="integer", unique=true)
     */
    private $productCode;


    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", unique=true)
     */

    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="productName", type="string", length=100, unique=true)
     */

    private $productName;





    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Winetype", inversedBy="idtype")
     */

    private $winetype;


    /**
     *
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="WineArea", inversedBy="$areawine")
     */

    private $winearea;

    /**
     * @var string
     *
     * @ORM\Column(name="productCountry", type="string", length=100)
     */

    private $productCountry;


    /**
     * @var
     *
     * @ORM\Column(name="productImage", type="string", length=50)
     */

    private $productImage;




    /**
     * @var string
     *
     * @ORM\Column(name="productVendor", type="string", length=100)
     */
    private $productVendor;

    /**
     * @var string
     *
     * @ORM\Column(name="productDescription", type="text")
     */
    private $productDescription;

    /**
     * @var int
     *
     * @ORM\Column(name="quantityInStock", type="integer")
     */
    private $quantityInStock;

    /**
     * @var int
     *
     * @ORM\Column(name="buyPrice", type="float")
     */
    private $buyPrice;

    /**
     * @var int
     *
     * @ORM\Column(name="salePrice", type="float")
     */
    private $salePrice;


    /**
     *
     * @var int
     *
     * @ORM\Column(name="year", type="integer", length=4)
     */


    private $year;




    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set productCode
     *
     * @param integer $productCode
     *
     * @return products
     */
    public function setProductCode($productCode)
    {
        $this->productCode = $productCode;

        return $this;
    }

    /**
     * Get productCode
     *
     * @return int
     */
    public function getProductCode()
    {
        return $this->productCode;
    }

    /**
     * Set productName
     *
     * @param string $productName
     *
     * @return products
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;

        return $this;
    }

    /**
     * Get productName
     *
     * @return string
     */
    public function getProductName()
    {
        return $this->productName;
    }



    /**
     * Set productVendor
     *
     * @param string $productVendor
     *
     * @return products
     */
    public function setProductVendor($productVendor)
    {
        $this->productVendor = $productVendor;

        return $this;
    }

    /**
     * Get productVendor
     *
     * @return string
     */
    public function getProductVendor()
    {
        return $this->productVendor;
    }

    /**
     * Set productDescription
     *
     * @param string $productDescription
     *
     * @return products
     */
    public function setProductDescription($productDescription)
    {
        $this->productDescription = $productDescription;

        return $this;
    }

    /**
     * Get productDescription
     *
     * @return string
     */
    public function getProductDescription()
    {
        return $this->productDescription;
    }

    /**
     * Set quantityInStock
     *
     * @param integer $quantityInStock
     *
     * @return products
     */
    public function setQuantityInStock($quantityInStock)
    {
        $this->quantityInStock = $quantityInStock;

        return $this;
    }

    /**
     * Get quantityInStock
     *
     * @return int
     */
    public function getQuantityInStock()
    {
        return $this->quantityInStock;
    }

    /**
     * Set buyPrice
     *
     * @param integer $buyPrice
     *
     * @return products
     */
    public function setBuyPrice($buyPrice)
    {
        $this->buyPrice = $buyPrice;

        return $this;
    }

    /**
     * Get buyPrice
     *
     * @return int
     */
    public function getBuyPrice()
    {
        return $this->buyPrice;
    }

    /**
     * Set salePrice
     *
     * @param integer $salePrice
     *
     * @return products
     */
    public function setSalePrice($salePrice)
    {
        $this->salePrice = $salePrice;

        return $this;
    }

    /**
     * Get salePrice
     *
     * @return int
     */
    public function getSalePrice()
    {
        return $this->salePrice;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Products
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set productImage
     *
     * @param string $productImage
     *
     * @return Products
     */
    public function setProductImage($productImage)
    {
        $this->productImage = $productImage;

        return $this;
    }

    /**
     * Get productImage
     *
     * @return string
     */
    public function getProductImage()
    {
        return $this->productImage;
    }

    /**
     * Set year
     *
     * @param integer $year
     *
     * @return Products
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer
     */
    public function getYear()
    {
        return $this->year;
    }




    /**
     * Set productCountry
     *
     * @param string $productCountry
     *
     * @return Products
     */
    public function setProductCountry($productCountry)
    {
        $this->productCountry = $productCountry;

        return $this;
    }

    /**
     * Get productCountry
     *
     * @return string
     */
    public function getProductCountry()
    {
        return $this->productCountry;
    }



    /**
     * Set winetype
     *
     * @param \AppBundle\Entity\Winetype $winetype
     *
     * @return Products
     */
    public function setWinetype(\AppBundle\Entity\Winetype $winetype = null)
    {
        $this->winetype = $winetype;

        return $this;
    }

    /**
     * Get winetype
     *
     * @return \AppBundle\Entity\Winetype
     */
    public function getWinetype()
    {
        return $this->winetype;
    }

    /**
     * Set winearea
     *
     * @param \AppBundle\Entity\WineArea $winearea
     *
     * @return Products
     */
    public function setWinearea(\AppBundle\Entity\WineArea $winearea = null)
    {
        $this->winearea = $winearea;

        return $this;
    }

    /**
     * Get winearea
     *
     * @return \AppBundle\Entity\WineArea
     */
    public function getWinearea()
    {
        return $this->winearea;
    }
}
