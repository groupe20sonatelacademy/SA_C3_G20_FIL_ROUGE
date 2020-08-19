<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArchivageReferentielController extends AbstractController
{
    /**
     * @Route("/archivage/referentiel", name="archivage_referentiel")
     */
    public function index()
    {
        return $this->render('archivage_referentiel/index.html.twig', [
            'controller_name' => 'ArchivageReferentielController',
        ]);
    }
}
