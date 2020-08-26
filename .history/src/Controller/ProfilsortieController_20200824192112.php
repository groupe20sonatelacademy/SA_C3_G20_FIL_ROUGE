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
        if ($profilsortie) {

            foreach ($profilsortie->get() as  $brief) {
                if ($brief->getStatut() != "brouillon") {
                    $profilsortie->removeBrief($brief);
                }
            }

            return $this->json($formateur->getBriefs(), 200, [], ["groups" => ["brouillon:read"]]);
        }


        return $this->render('profilsortie/index.html.twig', [
            'controller_name' => 'ProfilsortieController',
        ]);
    }
}
