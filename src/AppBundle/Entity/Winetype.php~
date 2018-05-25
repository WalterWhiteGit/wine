<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Winetype
 *
 * @ORM\Table(name="winetype")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\WinetypeRepository")
 */
class Winetype
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
     *
     * @ORM\OneToMany(targetEntity="Products",mappedBy="winetype")
     *
     */

    private $idtype;



    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=50, unique=true)
     */
    private $type;


    /**
     * @var string
     *
     * @ORM\Column(name="imgtype", type="string", length=50)
     */
    private $imgtype;


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
     * Set type
     *
     * @param string $type
     *
     * @return Winetype
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idtype = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add idtype
     *
     * @param \AppBundle\Entity\Products $idtype
     *
     * @return Winetype
     */
    public function addIdtype(\AppBundle\Entity\Products $idtype)
    {
        $this->idtype[] = $idtype;

        return $this;
    }

    /**
     * Remove idtype
     *
     * @param \AppBundle\Entity\Products $idtype
     */
    public function removeIdtype(\AppBundle\Entity\Products $idtype)
    {
        $this->idtype->removeElement($idtype);
    }

    /**
     * Get idtype
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdtype()
    {
        return $this->idtype;
    }

    /**
     * Set imgtype
     *
     * @param string $imgtype
     *
     * @return Winetype
     */
    public function setImgtype($imgtype)
    {
        $this->imgtype = $imgtype;

        return $this;
    }

    /**
     * Get imgtype
     *
     * @return string
     */
    public function getImgtype()
    {
        return $this->imgtype;
    }
}
