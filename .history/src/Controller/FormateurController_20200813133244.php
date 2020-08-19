<?php

namespace App\Controller;


use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class FormateurController extends AbstractController
{

    /**
     * @Route("/formateur", name="competence")
     */
    public function index()
    {
        return $this->render('formateur/index.html.twig', [
            'controller_name' => 'CompetenceController',
        ]);
    }

     
}
