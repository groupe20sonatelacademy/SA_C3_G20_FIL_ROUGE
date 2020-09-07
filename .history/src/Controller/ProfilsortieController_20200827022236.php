<?php

namespace App\Controller;

use App\Repository\PromoRepository;
use App\Repository\ApprenantRepository;
use App\Repository\GroupeRepository;
use App\Repository\ProfilsortieRepository;
use App\Repository\ProfilsRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Serializer;

class ProfilsortieController extends AbstractController
{
    /**
     * @Route(
     *    name="getProfilsortieAndApprenant",
     *     path="api/admin/profilsorties/{id}",
     *      methods={"GET"}
     *     )
     */
    // on affiche les profils de sortie d'une promo

    // public function getProfilsortieAndApprenant(int $id,ProfilsortieRepository $profilsortieRepository,ApprenantRepository $apprenantRepository)
    // {

    //     $profils = $profilsortieRepository->findOneBy(["id" => $id]);
       
    //     if ($profils) {
    //         return $this->json($profils, 200, [], ["groups" => ["profilsortieApp:read"]]);
    //     }
    //     return $this->json(["message" => "ressource inexistante", 404]);
       
    // }

    /**
     * @Route(
     *    name="getProfilsortieAtPromo",
     *     path="api/admin/promos/{id_promo}/profilsorties/{id_profilsortie}",
     *      methods={"GET"}
     *     )
     */

     // on affiche les apprenant d'un profils de sortie d'une promo
    public function getProfilsortieAtPromo($id_promo,$id_profilsortie, ProfilsortieRepository 
    $profilsortieRepository, PromoRepository $promoRepository, GroupeRepository $groupeRepository)

    {
        $promo = $promoRepository->findOneBy(["id" => $id_promo]);
        //dd($promo);il maffiche la promo
        if($promo){

            foreach ($promo->getGroupe() as  $value) {
                $promos = $groupeRepository->find($value);
                
               // dd($promos);   il maffiche la promo et le groupe principa
                $profils = $profilsortieRepository->findOneBy(["id" => $id_profilsortie]);
               // dd($profils); il m'affiche leprofils de sortie
                if($promos->getApprenant()==$profils){
                    
                    return $this->json($profils, 200, [], ["groups" => ["promoProfilsortie:read"]]);
                }
              
            }
       
        }

    }

           // dd($profils);

        //     if($profils){

        //         $promos = $promo->getGroupe();
        //         foreach ($promos as $groupes) {

        //             if ($groupes->getApprenant() == $profils ){
                        
        //                 return $this->json($profils, 200, [], ["groups" => ["promoProfilsortie:read"]]);
        //             }
        
        //     }

        // }

        // return $this->json(["message" => "ressource inexistante", 404]);
   



    /**
     * @Route(
     *    name="getApprenantAtPromo",
     *     path="api/admin/promos/{id}/profilsorties",
     *      methods={"GET"}
     *     )
     */
       // On affiche les apprenants d'une promo par profils de sortie

      public function getApprenantAtPromo(int $id , PromoRepository $promoRepository, GroupeRepository $groupeRepository)
        {
            $apprenants=[];
            
                $promo = $promoRepository->findOneBy(["id" => $id]);

                if ($promo) {
                  foreach ($promo->getGroupe() as  $value) {
                 $apprenants[]=$groupeRepository->find($value);
                 //dd($apprenants);   il maffiche la promo
                  }
                  foreach($apprenants as  $profils) {

                      if($profils->getApprenant()){
                          $apprenant= $profils->getApprenant();
                       //  dd($apprenant); il affiche promo et groupe principale
                         foreach ($apprenant as  $value) {
                             if($value->getProfilsortie()){
                                 $groupe= $value->getProfilsortie();
                           
                             }
                         }

                    return $this->json($groupe, 200, [], ["groups" => ["profilsortieApp:read"]]);
                      }
                  }


                   
                }
        return $this->json(["message" => "ressource inexistante", 404]);
       
        }
     



}
