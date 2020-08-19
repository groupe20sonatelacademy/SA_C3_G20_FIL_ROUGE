<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArchivageGroupeTagController extends AbstractController
{
    /**
     * @Route("/archivage/groupe/tag", name="archivage_groupe_tag")
     */
    public function index()
    {
        return $this->render('archivage_groupe_tag/index.html.twig', [
            'controller_name' => 'ArchivageGroupeTagController',
        ]);
    }
}
