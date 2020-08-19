<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArchivageCompetenceController extends AbstractController
{
    /**
     * @Route("/archivage/competence", name="archivage_competence")
     */
    public function index()
    {
        return $this->render('archivage_competence/index.html.twig', [
            'controller_name' => 'ArchivageCompetenceController',
        ]);
    }
}
