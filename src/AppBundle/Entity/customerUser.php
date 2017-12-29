<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * customerUser
 *
 * @ORM\Table(name="customer_user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\customerUserRepository")
 *
 */
class customerUser implements UserInterface, \Serializable
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
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=100)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=100)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var int
     *
     * @ORM\Column(name="phonenumber", type="integer")
     */
    private $phonenumber;


    /**
     * @ORM\Column(type="string", length=100)
     */

    private $avatar;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, unique=true)
     */
    private $password;


    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string")
     */

    private $address;


    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string")
     */

    private $city;

    /**
     * @var integer
     *
     * @ORM\Column(name="postalCode", type="integer")
     */

    private $postalCode;


    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string")
     */

    private $country;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;



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
     * Set username
     *
     * @param string $username
     *
     * @return customerUser
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return customerUser
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return customerUser
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return customerUser
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phonenumber
     *
     * @param integer $phonenumber
     *
     * @return customerUser
     */
    public function setPhonenumber($phonenumber)
    {
        $this->phonenumber = $phonenumber;

        return $this;
    }

    /**
     * Get phonenumber
     *
     * @return int
     */
    public function getPhonenumber()
    {
        return $this->phonenumber;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return customerUser
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }


    /**
     * Set avatar
     *
     * @param string $avatar
     *
     * @return customerUser
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }


    /**
     * Set address
     *
     * @param string $address
     *
     * @return customerUser
     */

    public function setAddress($address)
    {
        $this->address= $address;

        return $this;

    }


    /**
     * Get address
     *
     * @return string
     */

    public function getAddress()
    {
        return $this->address;

    }


    /**
     * Set city
     *
     * @param string $city
     *
     * @return customerUser
     */

    public function setCity($city)
    {
        $this->city =$city;

        return $this;

    }


    /**
     * Get city
     *
     * @return string
     */

    public function getCity ()
    {

        return $this->city;
    }


    /**
     * Set postalCode
     *
     * @param integer $postalCode
     *
     * @return customerUser
     */

    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return int
     */

    public function getPostalCode()
    {

        return $this->postalCode;

    }


    /**
     * Set country
     *
     * @param string $country
     *
     * @return customerUser
     */

    public function setCountry($country)
    {
        $this->country = $country;

        return $this;

    }

    /**
     * Get country
     *
     * @return string
     */

    public function getCountry()
    {
        return $this->country;

    }


    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return customerUser
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    public function __construct()
    {
        $this->isActive = true;
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid('', true));
    }




    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }


    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }
}
