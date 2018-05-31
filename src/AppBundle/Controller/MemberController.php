<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MemberController extends Controller
{
    /**
     * @Route("/member/", name="userHomepage")
     */
    public function userHomeAction()
    {
        return $this->render('member/homepage.html.twig');
    }

}