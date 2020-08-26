<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProfilsortieController extends AbstractController
{
    /**
     * @Route(
     *    name="getProfilSortieAndApprenant",
     *     path="/profilsortie/{id}",
     *      methods={"GET"}
     * 
     *     )
     */
    public function index()
    {
        return $this->render('profilsortie/index.html.twig', [
            'controller_name' => 'ProfilsortieController',
        ]);
    }
}
