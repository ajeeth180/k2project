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
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->add('save', SubmitType::class, array('label' => "Registreer"));
        $form->handleRequest($request);
        $bestaande_user = $this->getDoctrine()->getRepository(User::class)->findOneBy(array('username' => $form->getData()->getUsername()));
        if($bestaande_user)
        {
            $this->addFlash(
                'error',
                $user->getUsername()." bestaat al!"
            );

            return $this->redirectToRoute('homepage');
        }
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
            return $this->render('default/register.html.twig', [
                'form'=>$form->createView()
            ]);
        }
        return $this->render('default/register.html.twig', [
            'form'=>$form->createView()
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
