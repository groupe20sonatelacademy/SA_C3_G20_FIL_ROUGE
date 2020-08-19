<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArchivageUserController extends AbstractController
{
    /**
     * @Route("/archivage/user", name="archivage_user")
     */
    public function index()
    {
        return $this->render('archivage_user/index.html.twig', [
            'controller_name' => 'ArchivageUserController',
        ]);
    }
}
