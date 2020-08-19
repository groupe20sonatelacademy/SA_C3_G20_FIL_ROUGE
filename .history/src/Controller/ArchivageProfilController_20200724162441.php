<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ArchivageProfilController extends AbstractController
{
    /**
     * Undocumented variable
     * 
     * @var EntityManagerInterface
     */
    private
    public function index()
    {
        return $this->render('archivage_profil/index.html.twig', [
            'controller_name' => 'ArchivageProfilController',
        ]);
    }
}
