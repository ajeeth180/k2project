<?php
/**
 * Created by PhpStorm.
 * User: Amaru Signore
 * Date: 24-5-2018
 * Time: 14:55
 */

namespace AppBundle\Controller;

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
        $aanbod = $this->getDoctrine()->getRepository(Training::class)->findAll();

        return $this->render('instructor/homepage.html.twig', [
            'aanbod' => $aanbod
        ]);
    }

    /**
     * @Route("/admin/soortadd", name="soortadd")
     */
    public function AddAction(Request $request)
    {
        // create a user and a contact
        $a=new User();
        $form = $this->createForm(UserType::class, $a);
        $form->add('save', SubmitType::class, array('label'=>"voeg toe"));
        //$form->add('reset', ResetType::class, array('label'=>"reset"));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($a);
            $em->flush();
            $this->addFlash(
                'notice',
                'soort activiteit toegevoegd!'
            );
            return $this->redirectToRoute('soortbeheer');
        }
        $entities = $this->getEntities();
        return $this->render('medewerker/addsoort.html.twig',array('form'=>$form->createView(),'naam'=>'toevoegen','aantalA'=>count($entities["activiteiten"]),'aantalS'=>count($entities["soorten"]),'aantalU'=>count($entities["deelnemers"])));
    }

    /**
     * @Route("/admin/updatesoort/{id}", name="updatesoort")
     */
    public function updateAction($id,Request $request)
    {
        $a=$this->getDoctrine()
            ->getRepository('AppBundle:Soortactiviteit')
            ->find($id);
        $form = $this->createForm(SoortType::class, $a);
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
                'soort aangepast!'
            );
            return $this->redirectToRoute('soortbeheer');
        }
        $entities = $this->getEntities();
        return $this->render('medewerker/addsoort.html.twig',array('form'=>$form->createView(),'naam'=>'aanpassen','aantalA'=>count($entities["activiteiten"]),'aantalS'=>count($entities["soorten"]),'aantalU'=>count($entities["deelnemers"])));
    }

    /**
     * @Route("/admin/deletesoort/{id}", name="deletesoort")
     */
    public function deleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $a= $this->getDoctrine()
            ->getRepository('AppBundle:Soortactiviteit')->find($id);
        $em->remove($a);
        $em->flush();
        $this->addFlash(
            'notice',
            'soort verwijderd!'
        );
        return $this->redirectToRoute('soortbeheer');
    }


}