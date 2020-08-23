<?php

namespace App\Controller;

use App\Repository\BriefRepository;
use App\Repository\PromoRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BriefController extends AbstractController
{
    /**
     * @Route(
     *      name="Afficher_brief",               
     *         path = "/api/formateurs/briefs",
     *         methods={"GET"},
     *          defaults={ 
     *            "controller"="App/BriefController::getBrief",
     *            "api_resource_class"= Brief::class,
     *            "api_collection_operation_name"="getBrief"
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
     *         path = "/api/formateurs/promos/{id_promo}/groupes/{id_groupe}/briefs",
     *         requirements={"id"="\d+"},
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
    public function ListerBriefPromoGroupe( $id_promo, $id_groupe ,PromoRepository $promoRepository,BriefRepository $briefRepository)
     {

        $brief=[];
        $promo = $promoRepository->find($id_promo);
    if(!empty($promo)){
       foreach($promo->getGroupe() as $groupes){
              if($groupes->getId()==$id_groupe){
              break;
               }
               $groupes=null;
           }
           if(!empty($groupes)){
               $brief[]=$briefRepository->findOneBy(["id"=>$groupes->getBriefs()]);
           
                    return $this->json($brief,Response::HTTP_OK,[], ["groups" => "brief:read"]);
           } else {
                return new Response("ce groupe n'existe pas");
            }

        }
        return $this ->json(['message'=>'le promo est inexistente'],Response::HTTP_NOT_FOUND);

    }




   
}
