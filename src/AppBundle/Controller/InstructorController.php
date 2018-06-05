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
use AppBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

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
     * @Route("/instructor/add", name="add")
     */
    public function addAction(Request $request)
    {
        // create a user and a contact
        $a=new Lesson();
        $form = $this->createForm(LessonType::class, $a);
        $form->add('save', SubmitType::class, array('label'=>"voeg toe"));
        //$form->add('reset', ResetType::class, array('label'=>"reset"));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($a);
            $em->flush();
            $this->addFlash(
                'notice',
                'lesson toegevoegd!'
            );
            return $this->redirectToRoute('beheer');
        }
        $entities = $this->getEntities();
        return $this->render('medewerker/add.html.twig',array('form'=>$form->createView(),'naam'=>'toevoegen','aantalA'=>count($entities["activiteiten"]),'aantalT'=>count($entities["trainingen"]),'aantalU'=>count($entities["deelnemers"])));
    }

}