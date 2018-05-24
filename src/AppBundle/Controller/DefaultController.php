<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/aanbod", name="aanbod")
     */
    public function aanbodAction(Request $request)
    {
        return $this->render('default/aanbod.html.twig', [
        ]);
    }

    /**
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request)
    {
        return $this->render('default/register.html.twig', [
        ]);
    }

    /**
     * @Route("/gedrag", name="gedrag")
     */
    public function gedragAction(Request $request)
    {
        return $this->render('default/gedrag.html.twig', [
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contractAction(Request $request)
    {
        return $this->render('default/contact.html.twig', [
        ]);
    }
}
