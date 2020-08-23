<?php

namespace App\Controller;

use App\Repository\BriefRepository;
use App\Repository\GroupeRepository;
use App\Repository\PromoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
     *         path = "/api/formateurs/promos/{id_promo}/groupes/{id_groupe}/briefs",
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
    public function ListerBriefPromoGroupe( int $id,PromoRepository $promoRepository,
     GroupeRepository $groupeRepository)

     {

         $briefpromo= $promoRepository->findBy($id);
        return $this->json($promoRepository->findAll(), 200, [], ["groups" => "brief:read"]);

    }

}
