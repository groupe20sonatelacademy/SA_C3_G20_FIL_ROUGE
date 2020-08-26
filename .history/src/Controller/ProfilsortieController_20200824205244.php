<?php

namespace App\Controller;

use App\Repository\ApprenantRepository;
use App\Repository\ProfilsortieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProfilsortieController extends AbstractController
{
    /**
     * @Route(
     *    name="getProfilsortieAndApprenant",
     *     path="api/admin/profilsorties/{id}",
     *      methods={"GET"}
     *     )
     */
    public function getProfilsortieAndApprenant(int $id,ProfilsortieRepository $profilsortieRepository,ApprenantRepository $apprenantRepository)
    {

        $profils = $profilsortieRepository->findOneBy(["id" => $id]);
       
        
        if ($profils) {
            if ($profils->getApprenant()) {
               $profil= $profils->getApprenant();
            }
//dd($profil);

            return $this->json($profil, 200, [], ["groups" => ["profilsortieApp:read"]]);
        }
        return $this->json(["message" => "ressource inexistante", 404]);
       
    }

    /**
     * @Route(
     *    name="getProfilsortieAtPromo",
     *     path="api/admin/promos/id_promo/profilsorties/id_profilsortie",
     *      methods={"GET"}
     *     )
     */
    public function getProfilsortieAtPromo(int $id, ProfilsortieRepository $profilsortieRepository, ApprenantRepository $apprenantRepository)
    {

        $profilPROMO = $profilsortieRepository->findOneBy(["id" => $id]);
       

    }










}
