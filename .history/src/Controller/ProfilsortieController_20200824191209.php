<?php

namespace App\Controller;

use App\Repository\ProfilsortieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProfilsortieController extends AbstractController
{
    /**
     * @Route(
     *    name="getProfilsortieAndApprenant",
     *     path="/profilsortie/{id}",
     *      methods={"GET"}
     * 
     *     )
     */
    public function getProfilsortieAndApprenant(int $id,ProfilsortieRepository $profils)
    {
        return $this->render('profilsortie/index.html.twig', [
            'controller_name' => 'ProfilsortieController',
        ]);
    }
}
