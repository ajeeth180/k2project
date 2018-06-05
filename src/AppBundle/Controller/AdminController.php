<?php
/**
 * Created by PhpStorm.
 * User: Amaru Signore
 * Date: 24-5-2018
 * Time: 14:55
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Training;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

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
     * @Route("/admin/trainingsoverzicht", name="trainingsoverzicht")
     */
    public function adminTrainingAction()
    {

    }
}