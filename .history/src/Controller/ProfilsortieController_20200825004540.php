<?php

namespace App\Controller;

use App\Repository\PromoRepository;
use App\Repository\ApprenantRepository;
use App\Repository\ProfilsortieRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
            return $this->json($profils, 200, [], ["groups" => ["profilsortieApp:read"]]);
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
    public function getProfilsortieAtPromo($id_promo,$id_profilsortie, ProfilsortieRepository $profilsortieRepository, PromoRepository $promoRepository)
    {

        $promo = $promoRepository->findOneBy(["id" => $id_promo]);
       
       if($promo){
            $profils = $profilsortieRepository->findOneBy(["id" => $id_profilsortie]);
            if($profils){

                $groupe = $promo->getgroupe()->getApprenant();
                foreach ($groupe as $groupes) {

                    if ($$grou->getBrief() == $brief) {

                        return $this->json($brief, 200, [], ["groups" => ["promo:read"]]);
                    }
                }
            }
       }








    }










}
