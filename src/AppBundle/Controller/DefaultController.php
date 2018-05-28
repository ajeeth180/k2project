<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Training;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request, AuthenticationUtils $authenticationUtils)
    {

        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        if(isset($error))
        {
            $this->addFlash(
                'error',
                'Gegevens kloppen niet.'
            );
        }
        return $this->render('default/index.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ));
    }

    /**
     * @Route("/aanbod", name="aanbod")
     */
    public function aanbodAction(Request $request)
    {
        $aanbod = $this->getDoctrine()->getRepository(Training::class)->findAll();

        return $this->render('default/aanbod.html.twig', [
            'aanbod' => $aanbod
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
