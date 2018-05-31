<?php
/**
 * Created by PhpStorm.
 * User: Amaru Signore
 * Date: 24-5-2018
 * Time: 14:55
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MemberController extends Controller
{
    /**
     * @Route("/user/", name="userHomepage")
     */
    public function userHomeAction()
    {
        return $this->render("member/homepage.html.twig");
    }
}