<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Training;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
    public function aanbodAction(Request $request, AuthenticationUtils $authenticationUtils)
    {
        $aanbod = $this->getDoctrine()->getRepository(Training::class)->findAll();

        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        if(isset($error))
        {
            $this->addFlash(
                'error',
                'Gegevens kloppen niet.'
            );
        }
        return $this->render('default/aanbod.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
            'aanbod' => $aanbod
        ]);
    }

    /**
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder, AuthenticationUtils $authenticationUtils)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->add('save', SubmitType::class, array('label' => "Registreer"));
        $form->handleRequest($request);

        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();


        if($form->isSubmitted() && $form->isValid())
        {
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $user->setRoles(["ROLE_USER"]);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash(
                'notice',
                $user->getUsername() . " is geregistreerd"
            );

            return $this->redirectToRoute('homepage');
        }
        else
        {
            $this->addFlash(
                'error',
                $user->getUsername()." bestaat al!"
            );
        }
        return $this->render('default/register.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/gedrag", name="gedrag")
     */
    public function gedragAction(Request $request, AuthenticationUtils $authenticationUtils)
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
        return $this->render('default/gedrag.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contractAction(Request $request, AuthenticationUtils $authenticationUtils)
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
        return $this->render('default/contact.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error
        ]);
    }
}
