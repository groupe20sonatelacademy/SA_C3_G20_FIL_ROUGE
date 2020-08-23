<?php

namespace App\Controller;


use App\Repository\BriefRepository;
use App\Repository\PromoRepository;
use App\Repository\GroupeRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Promo;

class BriefController extends AbstractController
{
    /**
     * @Route(
     *      name="Afficher_brief",               
     *         path = "/api/formateurs/briefs",
     *         methods={"GET"},
     *          defaults={ 
     *            "controller"="App/BriefController::ListerBrief",
     *            "api_resource_class"= Brief::class,
     *            "api_collection_operation_name"="Lister_Brief"
     *       },
     * )
     * 
     */
    public function ListerBrief(BriefRepository $briefRepository ){

        return $this->json($briefRepository->findAll(),200,[],["groups"=>"brief:read"]);
   
    }



    /**
     * @Route(
     *         name="Afficher_brief_groupe_promo",               
     *         path = "/api/formateurs/promos/{id_promo<\id+>}/groupes/{id_groupe<\id+>}/briefs",
     *         methods={"GET"},
     *         defaults={ 
     *            "controller"="App/BriefController::ListerBriefPromoGroupe",
     *            "api_resource_class"= Brief::class,
     *            "api_collection_operation_name"="Lister_Brief_promo_groupe"
     *       },
     * )
     * 
     * 
     */
    public function ListerBriefPromoGroupe( $id_promo, $id_groupe ,PromoRepository $promoRepository,

     BriefRepository $briefRepository)

     {

        $brief= [];


        $promo = $promoRepository->find($id_promo);
  if(!empty($promo)){
       foreach($promo->getGroupe() as $groupes){
              if($groupes->getId()==$id_groupe){
              break;
               }
               $groupes=null;
               dd($groupes);
           }
           if(!empty($groupes)){
               $brief[]=$briefRepository()->findOneBy(["id"=>$groupes->getBrief()->getId()]);
           
                    return $this->json($brief,Response::HTTP_OK,[], ["groups" => "brief:read"]);
           } else {
                return new Response("ce groupe n'existe pas");
            }

        }
        return $this 
        
        
         


    }

}
