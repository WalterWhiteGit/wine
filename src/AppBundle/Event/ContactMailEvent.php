<?php
/**
 * Created by PhpStorm.
 * User: samy
 * Date: 06/11/2017
 * Time: 11:32
 */

namespace AppBundle\Event;


use Symfony\Component\EventDispatcher\Event;

class ContactMailEvent extends Event
{

    // Events list
    const Send_Mail_Contact = 'app.contact.events.send.mail';

}