<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WineArea
 *
 * @ORM\Table(name="wine_area")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\WineAreaRepository")
 */
class WineArea
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
     * @var string
     *
     * @ORM\Column(name="area", type="string", length=255, unique=true)
     */
    private $area;


    /**
     *
     * @ORM\OneToMany(targetEntity="Products", mappedBy="winearea")
     */

    private $areawine;


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
     * Set area
     *
     * @param string $area
     *
     * @return WineArea
     */
    public function setArea($area)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get area
     *
     * @return string
     */
    public function getArea()
    {
        return $this->area;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->areawine = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add areawine
     *
     * @param \AppBundle\Entity\Products $areawine
     *
     * @return WineArea
     */
    public function addAreawine(\AppBundle\Entity\Products $areawine)
    {
        $this->areawine[] = $areawine;

        return $this;
    }

    /**
     * Remove areawine
     *
     * @param \AppBundle\Entity\Products $areawine
     */
    public function removeAreawine(\AppBundle\Entity\Products $areawine)
    {
        $this->areawine->removeElement($areawine);
    }

    /**
     * Get areawine
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAreawine()
    {
        return $this->areawine;
    }
}
