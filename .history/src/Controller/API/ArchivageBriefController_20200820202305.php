<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArchivageBriefController extends AbstractController
{
    /**
     * @Route("/archivage/brief", name="archivage_brief")
     */
    public function index()
    {
        return $this->render('archivage_brief/index.html.twig', [
            'controller_name' => 'ArchivageBriefController',
        ]);
    }
}
