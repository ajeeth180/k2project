<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Lesson;
use AppBundle\Entity\Registration;
use AppBundle\Entity\User;
use AppBundle\Form\UserWijzigType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\RedirectResponse;

class MemberController extends Controller
{
    /**
     * @Route("/member/", name="userHomepage")
     */
    public function userHomeAction()
    {
        return $this->render('member/homepage.html.twig');
    }

    /**
     * @Route("/member/wijzig", name="userWijzig")
     */
    public function userWijzigAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $u= $this->get('security.token_storage')->getToken()->getUser();
        $form = $this->createForm(UserWijzigType::class, $u);
        $form->add('save', SubmitType::class, array('label' => "Wijzig Gegevens"));
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $bestaande_user = $this->getDoctrine()->getRepository(User::class)->findOneBy(array('username' => $form->getData()->getUsername()));
            $updated_user = $form->getData();

            if ($bestaande_user && $u !== $bestaande_user)//betekend dat de username nog niet bestaat
            {
                $this->addFlash(
                    'error',
                    $u->getUsername() . " bestaat al!"
                );
                return $this->render('member/wijzig.html.twig', [
                    'form'=>$form->createView()
                ]);
            }
            else
            {
                if(!$updated_user->getPassword() || $updated_user->getPassword() == "")
                {
                    $password_ = $u->getPassword();
                }
                else
                {
                    $password_ = $updated_user->getPassword();
                }
            }
            $password = $passwordEncoder->encodePassword($u, $password_);
            $u->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($u);
            $em->flush();

            $this->addFlash(
                'notice',
                $u->getUsername() . " is gewijzigd!"
            );

            return $this->redirectToRoute('userHomepage');
        }
        return $this->render('member/wijzig.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/member/aanbod", name="userAanbod")
     */
    public function userAanbodAction()
    {
        $lessons = $this->getDoctrine()->getRepository(Lesson::class)->findAll();
        $registratons = $this->getDoctrine()->getRepository(Registration::class)->find();

        return $this->render('member/userAanbod.html.twig', [
            'lessons' => $lessons
        ]);
    }

}