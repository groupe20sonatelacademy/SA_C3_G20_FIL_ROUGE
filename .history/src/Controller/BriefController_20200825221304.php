<?php

namespace App\Controller;

use App\Repository\ApprenantRepository;
use App\Repository\BriefRepository;
use App\Repository\FormateurRepository;
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

     // On affiche tous les briefs avec tag, ressource, niveaux et livrableAttendus

    public function getBrief(BriefRepository $briefRepository)
    {

        return $this->json($briefRepository->findAll(), 200, [], ["groups" => ["brief:read"]]);
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

    // On affiche les briefs d'un groupe d'une promo avec  tag, ressource, niveaux et livrableAttendus

    public function getBriefGroupeInPromo($id_promo, $id_groupe,
     PromoRepository $promoRepository, BriefRepository $briefRepository)
    {

        $brief = [];
        $promo = $promoRepository->find($id_promo);
        if (!empty($promo)) {
            foreach ($promo->getGroupe() as $groupes) {
                if ($groupes->getId() == $id_groupe) {
                    break;
                }
                $groupes = null;
            }
            if (!empty($groupes)) {
                foreach ($groupes->getEtatBriefGroupes() as $value) {
                    
               
                $brief[] = $briefRepository->findOneBy(["id" => $value->getBrief()->getId()]);
                }
                return $this->json($brief, Response::HTTP_OK, [], ["groups" => ["briefGroupe:read"]]);
            }
          return new Response("ce groupe n'existe pas");
            
        }
        return $this->json(['message' => 'la promo est inexistente'], Response::HTTP_NOT_FOUND);
    }

    /**
     * @Route(
     *      name="getBriefBrouillon",               
     *         path = "/api/formateurs/{id}/briefs/brouillons",
     *         methods={"GET"},
     *          
     * )
     * 
     */

     // On affiche les briefs btouillon d'un formateur

    public function getBriefBrouillon( FormateurRepository $formateurRepository, $id)
    {
        $formateur = $formateurRepository->findOneBy(["id" => $id]);

        
        if ($formateur) {

            foreach ($formateur->getBriefs() as  $brief) {
                if ($brief->getStatut() != "brouillon") {
                    $formateur->removeBrief($brief);
                }
            }
        
            return $this->json($formateur->getBriefs(), 200, [], ["groups" => ["brouillon:read"]]);
        }
    }


    /**
     * @Route(
     *      name="getBriefValide",               
     *         path = "/api/formateurs/{id}/briefs/valides",
     *         methods={"GET"},
     *          
     * )
     * 
     */

    //On affiche les briefs valide d'un formateur

    public function getBriefValide( FormateurRepository $formateurRepository, $id)
    {
        $formateur = $formateurRepository->findOneBy(["id" => $id]);

        
        if ($formateur) {

            foreach ($formateur->getBriefs() as  $brief) {
                if ($brief->getStatut() != "valide") {
                    $formateur->removeBrief($brief);
                }
            }

            return $this->json($formateur->getBriefs(), 200, [], ["groups" => ["valide:read"]]);
        }
    }



    /**
     * @Route(
     *      name="getPromoBrief",               
     *         path = "/api/formateurs/promos/{id}/briefs",
     *         methods={"GET"},
     *          
     * )
     * 
     */
 
     // On affiche les briefs d'un promo

    public function getPromoBrief(BriefRepository $briefRepository, PromoRepository $promoRepository, $id)
    {
        $briefs = [];
        $promo = $promoRepository->findOneBy(["id" => $id]);
        if ($promo) {

            foreach ($promo->getPromoBriefs() as  $promobrief) {
                $briefs[] = $briefRepository->find($promobrief->getBrief()->getId());
            }

            return $this->json($briefs, 200, [], ["groups" => ["promo:read"]]);
        }
        return $this->json(["message"=>"ressource inexistante",404]);

    }



    /**
     * @Route(
     *      name="getBriefInPromo",               
     *         path = "/api/formateurs/promos/{id_promo}/briefs/{id_brief}",
     *         methods={"GET"},
     *          
     * )
     * 
     */

     //On afiche un brief d'une promo

    public function getBriefInPromo(BriefRepository $briefRepository, PromoRepository $promoRepository, $id_promo,$id_brief)
    {
        $promo = $promoRepository->findOneBy(["id" => $id_promo]);
        if ($promo) {
            $brief = $briefRepository->findOneBy(["id" => $id_brief]);
           if($brief){
               $promobriefs=$promo->getPromoBriefs();
            foreach ($promobriefs as $promobrief) {

                if($promobrief->getBrief()==$brief) {
                    
                      return $this->json($brief, 200, [], ["groups" => ["promo:read"]]);
                }
            }
           }

            
        }
        return $this->json(["message" => "ressource inexistante", 404]);
    }



    /**
     * @Route(
     *      name="getPromoBriefAtApprenant",               
     *         path = "/api/apprenants/promos/{id}/briefs",
     *         methods={"GET"},
     *          
     * )
     * 
     */
    public function getPromoBriefAtApprenant(ApprenantRepository $apprenantRepository, BriefRepository $briefRepository, PromoRepository $promoRepository, $id)
    {
        // $promo = $promoRepository->findOneBy(["id" => $id]);
        // $apprenant= $apprenantRepository->findOneBy(["id"=>$id]);

        // dd($apprenant);
        // if ($apprenant) {
          
        //     foreach ($apprenant->getPromoBriefApprenants() as  $brief) {
        //         if ($brief->getStatut() != "assigner") {
        //             $apprenant->removePromoBriefApprenant($brief);
        //         }
        //     }

        //     return $this->json($apprenant->getPromoBriefApprenants(), 200, [], ["groups" => ["briefApprenant:read"]]);
        // }



        $brief = [];
        $promo = $promoRepository->findOneBy(["id" => $id]);
        if($promo) {

            foreach ($promo->getPromoBriefs() as  $promobrief) {
                $brief[] = $briefRepository->find($promobrief->getBrief()->getId());
            }

            return $this->json($brief, 200, [], ["groups" => ["briefApprenant:read"]]);
        }
        return $this->json(["message" => " cette ressource n'existes pas", 404]);
    }






}
