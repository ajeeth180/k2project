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



}