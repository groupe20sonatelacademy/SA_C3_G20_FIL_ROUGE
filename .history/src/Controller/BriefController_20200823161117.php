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
     *      name="getBrief",               
     *         path = "/api/formateurs/briefs",
     *         methods={"GET"},
     *          
     * )
     * 
     */
    public function getBrief(BriefRepository $briefRepository ){

        return $this->json($briefRepository->findAll(),200,[],["groups"=>"brief:read"]);
   
    }



    /**
     * @Route(
     *         name="getBriefGroupeInPromo",               
     *         path = "/api/formateurs/promos/{id_promo}/groupes/{id_groupe}/briefs",
     *         requirements={"id"="\d+"},
     *         methods={"GET"},
     *        
     * )
     * 
     * 
     */
    public function BriefPromoGroupe( $id_promo, $id_groupe ,PromoRepository $promoRepository,BriefRepository $briefRepository)
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
