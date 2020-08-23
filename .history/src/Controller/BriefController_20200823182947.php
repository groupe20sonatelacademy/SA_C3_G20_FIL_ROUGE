<?php

namespace App\Controller;

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
    public function getBriefGroupeInPromo($id_promo, $id_groupe, PromoRepository $promoRepository, BriefRepository $briefRepository)
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
                $brief[] = $briefRepository->findOneBy(["id" => $groupes->getBriefs()]);

                return $this->json($brief, Response::HTTP_OK, [], ["groups" => "brief:read"]);
            } else {
                return new Response("ce groupe n'existe pas");
            }
        }
        return $this->json(['message' => 'le promo est inexistente'], Response::HTTP_NOT_FOUND);
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
    public function getBriefBrouillon(BriefRepository $briefRepository, FormateurRepository $formateurRepository, $id)
    {
        $formateur = $formateurRepository->findOneBy(["id" => $id]);

        // dd($formateur);
        if ($formateur) {

            foreach ($formateur->getBriefs() as  $brief) {
                if ($brief->getStatut() != "brouillon") {
                    $formateur->removeBrief($brief);
                }
            }
            // dd($formateur->getBriefs());
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
    public function getBriefValide(BriefRepository $briefRepository, FormateurRepository $formateurRepository, $id)
    {
        $formateur = $formateurRepository->findOneBy(["id" => $id]);

        // dd($formateur);
        if ($formateur) {

            foreach ($formateur->getBriefs() as  $brief) {
                if ($brief->getStatut() != "valide" ) {
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
    public function getPromoBrief(BriefRepository $briefRepository, PromoRepository $promoRepository, $id)
    {
        $briefs=[];
        $promo = $promoRepository->findOneBy(["id" => $id]);
        if ($promo) {

            foreach ($promo->getPromoBriefs() as  $promobrief) {
                $briefs[]= $briefRepository->find($promobrief->getPromoBrief->getId())
            }

            return $this->json($formateur->getBriefs(), 200, [], ["groups" => ["valide:read"]]);
        }
    }










}
