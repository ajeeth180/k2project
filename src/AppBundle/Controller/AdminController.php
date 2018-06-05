<?php
/**
 * Created by PhpStorm.
 * User: Amaru Signore
 * Date: 24-5-2018
 * Time: 14:55
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Training;
use AppBundle\Form\TrainingType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    /**
     * @Route("/admin/", name="adminHomepage")
     */
    public function adminHomeAction()
    {
        $trainingen = $this->getDoctrine()->getRepository(Training::class)->findAll();

        return $this->render('admin/homepage.html.twig', [
            'trainingen' => $trainingen
        ]);
    }

    /**
     * @Route("/admin/addTraining", name="addTraining")
     */
    public function adminTAddAction(Request $request)
    {
        $training = new Training();
        $form = $this->createForm(TrainingType::class, $training);
        $form->add('save', SubmitType::class, array('label' => "Voeg toe"));
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            //TODO: nieuwe training mag niet dezelfde naam(description) hebben die al bestaat.
        }
    }

    /**
     * @Route("/admin/weizigTraining/{id}", name="weizigTraining")
     */
    public function adminTWeizigAction($id, Request $request)
    {
        $training = $this->getDoctrine()->getRepository(Training::class)->find($id);
        $form = $this->createForm(TrainingType::class, $training);
        $form->add('save', SubmitType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($training);
            $em->flush();
            $this->addFlash('notice', "succesvol geweizigd");

            return $this->redirectToRoute('adminHomepage');
        }

        return $this->render('admin/weizigTraining.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/admin/deleteTraining/{id}", name="deleteTraining")
     */
    public function adminTDeleteAction($id)
    {
        $training = $this->getDoctrine()->getRepository(Training::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($training);
        $em->flush();

        return $this->redirectToRoute('adminHomepage');
    }
}