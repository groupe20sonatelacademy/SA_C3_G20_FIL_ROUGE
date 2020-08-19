<?php

namespace App\Controller;


use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class FormateurController extends AbstractController
{

    /**
     * @Route("/competence", name="competence")
     */
    public function index()
    {
        return $this->render('/index.html.twig', [
            'controller_name' => 'CompetenceController',
        ]);
    }

     
}
