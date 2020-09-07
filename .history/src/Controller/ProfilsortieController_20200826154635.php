<?php

namespace App\Controller;

use App\Repository\PromoRepository;
use App\Repository\ApprenantRepository;
use App\Repository\ProfilsortieRepository;
use App\Repository\ProfilsRepository;
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
     *     path="api/admin/promos/{id_promo}/profilsorties/{id_profilsortie}",
     *      methods={"GET"}
     *     )
     */

     // on affiche les apprenant d'un profils de sortie d'une promo
    public function getProfilsortieAtPromo($id_promo,$id_profilsortie, ProfilsortieRepository 
    $profilsortieRepository, PromoRepository $promoRepository)

    {
    $promo = $promoRepository->findOneBy(["id" => $id_promo]);
      //dd($promo);
       if($promo){
            $profils = $profilsortieRepository->findOneBy(["id" => $id_profilsortie]);
           // dd($profils);

            if($profils){

                $promos = $promo->getGroupe();
                foreach ($promos as $groupes) {

                    if ($groupes->getApprenant() == $profils ){
                        
                        return $this->json($profils, 200, [], ["groups" => ["promoProfilsortie:read"]]);
                    }
        
            }

        }

        return $this->json(["message" => "ressource inexistante", 404]);
    }




    }

    /**
     * @Route(
     *    name="getApprenantAtPromo",
     *     path="api/admin/promos/{profilsorties/{id_profilsortie}",
     *      methods={"GET"}
     *     )
     */

public function getApprenantAtPromo(int $id , ProfilsRepository $profilsortieRepository){
        

}



}
