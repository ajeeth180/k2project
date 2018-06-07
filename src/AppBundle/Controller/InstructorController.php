<?php
/**
 * Created by PhpStorm.
 * User: Amaru Signore
 * Date: 24-5-2018
 * Time: 14:55
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Lesson;
use AppBundle\Entity\Training;
use AppBundle\Form\LessonType;
use AppBundle\Form\UserType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\ResetType;

class InstructorController extends Controller
{
    /**
     * @Route("/instructor/", name="instructorHomepage")
     */
    public function instructorHomeAction()
    {
        $lesson = $this->getDoctrine()->getRepository(Lesson::class)->findAll();

        return $this->render('instructor/homepage.html.twig', [
            'lesson' => $lesson
        ]);
    }

    /**
     * @Route("/instructor/add", name="addLesson")
     */
    public function addAction(Request $request)
    {
        // create a user and a contact
        $a=new Lesson();
        $form = $this->createForm(LessonType::class, $a);
        $form->add('save', SubmitType::class, array('label'=>"voeg toe"));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($a);
            $em->flush();
            $this->addFlash(
                'notice',
                'lesson is toegevoegd!'
            );
            return $this->redirectToRoute('instructorHomepage');
        }
        return $this->render('instructor/add.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/instructor/delete/{id}", name="deleteLesson")
     */
    public function deleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $a= $this->getDoctrine()->getRepository('AppBundle:Lesson')->find($id);
        $em->remove($a);
        $em->flush();
        $this->addFlash(
            'notice',
            'lesson is verwijderd!'
        );
        return $this->redirectToRoute('instructorHomepage');
    }

    /**
     * @Route("/instructor/update/{id}", name="updateLesson")
     */
    public function updateAction($id,Request $request)
    {
        $a=$this->getDoctrine()
            ->getRepository('AppBundle:Lesson')
            ->find($id);
        $form = $this->createForm(LessonType::class, $a);
        $form->add('save', SubmitType::class, array('label'=>"aanpassen"));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            // tells Doctrine you want to (eventually) save the contact (no queries yet)
            $em->persist($a);
            // actually executes the queries (i.e. the INSERT query)
            $em->flush();
            $this->addFlash(
                'notice',
                'lesson is aangepast!'
            );
            return $this->redirectToRoute('instructorHomepage');
        }

        return $this->render('instructor/add.html.twig', [
            'form'=>$form->createView()
        ]);
    }



}