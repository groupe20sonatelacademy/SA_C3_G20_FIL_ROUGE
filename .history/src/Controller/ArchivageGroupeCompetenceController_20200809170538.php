<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArchivageGroupeCompetenceController extends AbstractController
{
    /**
     * @Route("/archivage/groupe/competence", name="archivage_groupe_competence")
     */
    public function index()
    {
        return $this->render('archivage_groupe_competence/index.html.twig', [
            'controller_name' => 'ArchivageGroupeCompetenceController',
        ]);
    }
}
