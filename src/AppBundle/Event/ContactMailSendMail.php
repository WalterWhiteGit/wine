<?php
/**
 * Created by PhpStorm.
 * User: samy
 * Date: 06/11/2017
 * Time: 11:59
 */

namespace AppBundle\Event;


use Symfony\Component\EventDispatcher\Event;

class ContactMailSendMail extends Event
{

    private $email;

    private $firstname;

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }



}