<?php
/**
 * Created by PhpStorm.
 * User: samy
 * Date: 28/12/2017
 * Time: 10:33
 */

namespace AppBundle\Controller\Admin;



use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{

    /**
     * @Route("/admin", name="app.admin.homepage")
     */

    public function adminAction(){



        return $this->render ('admin/adminhomepage.html.twig');

    }


}