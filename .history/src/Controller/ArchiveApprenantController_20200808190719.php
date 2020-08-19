<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArchiveApprenantController extends AbstractController
{
    /**
     * @Route("/archive/apprenant", name="archive_apprenant")
     */
    public function index()
    {
        return $this->render('archive_apprenant/index.html.twig', [
            'controller_name' => 'ArchiveApprenantController',
        ]);
    }
}
