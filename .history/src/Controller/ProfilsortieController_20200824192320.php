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
     *     path="/admin/profilsortie/{id}",
     *      methods={"GET"}
     * 
     *     )
     */
    public function getProfilsortieAndApprenant(int $id,ProfilsortieRepository $profilsortieRepository)
    {

        $profilsortie = $profilsortieRepository->findOneBy(["id" => $id]);
        if ($profilsortie->getApprenant()) {

           

            return $this->json($profilsortie->getApprenant(), 200, [], ["groups" => ["profilsortieA:read"]]);
        }


        return $this->render('profilsortie/index.html.twig', [
            'controller_name' => 'ProfilsortieController',
        ]);
    }
}
