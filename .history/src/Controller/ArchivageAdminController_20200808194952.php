<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArchivageAdminController extends AbstractController
{
    /**
     * @Route("/archivage/admin", name="archivage_admin")
     */
    public function index()
    {
        return $this->render('archivage_admin/index.html.twig', [
            'controller_name' => 'ArchivageAdminController',
        ]);
    }
}
