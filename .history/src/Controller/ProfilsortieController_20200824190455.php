<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProfilsortieController extends AbstractController
{
    /**
     * @Route(
     *     path="/profilsortie",
     *  name="profilsortie")
     */
    public function index()
    {
        return $this->render('profilsortie/index.html.twig', [
            'controller_name' => 'ProfilsortieController',
        ]);
    }
}