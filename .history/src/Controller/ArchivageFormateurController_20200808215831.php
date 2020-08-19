<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArchivageFormateurController extends AbstractController
{
    /**
     * @Route("/archivage/formateur", name="archivage_formateur")
     */
    public function index()
    {
        return $this->render('archivage_formateur/index.html.twig', [
            'controller_name' => 'ArchivageFormateurController',
        ]);
    }
}
