<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArchivageProfilController extends AbstractController
{
    /**
     * Undocumented variable
     * 
     * @var 
     */
    public function index()
    {
        return $this->render('archivage_profil/index.html.twig', [
            'controller_name' => 'ArchivageProfilController',
        ]);
    }
}
