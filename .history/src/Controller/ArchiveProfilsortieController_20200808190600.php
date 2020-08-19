<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArchiveProfilsortieController extends AbstractController
{
    /**
     * @Route("/archive/profilsortie", name="archive_profilsortie")
     */
    public function index()
    {
        return $this->render('archive_profilsortie/index.html.twig', [
            'controller_name' => 'ArchiveProfilsortieController',
        ]);
    }
}
