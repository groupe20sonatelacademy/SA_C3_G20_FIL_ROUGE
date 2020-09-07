<?php

namespace App\Controller;

use App\Repository\ChatRepository;
use App\Repository\UserRepository;
use App\Repository\PromoRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ChatController extends AbstractController
{
    /**
     * @Route(
     *     name="getChats",
     *      path="api/user/promos/{id_promo}/apprenants/{id_apprenant}/chats",
     *     methods={"GET"}
     * )
     */
    // On recupere les commentaire  d'un apprenant d'une promo par jour





    public function getBriefGroupeInPromo(
        $id_promo,
        $id_apprenant,
        PromoRepository $promoRepository,
        UserRepository $userRepository,
        ChatRepository $chatRepository
    ) {

        $comments = [];
        $promo = $promoRepository->find($id_promo);
        if (!empty($promo)) {
            foreach ($promo->getGroupe() as $groupes) {
                if ($groupes->getApprenant()) {
                     $app=$groupes->getApprenant();
           //dd($app); ilnmaffiche le groupe
                foreach ($app as  $value) {
                    
                }
                    break;
                }
                $groupes = null;
            }
            if (!empty($groupes)) {
                foreach ($groupes->getApprenant() as $value) {


                    $comments[] = $chatRepository->findOneBy(["id" => $value->getChats()->getId()]);
                   // dd($comments);
                }
                return $this->json($comments, Response::HTTP_OK, [], ["groups" => ["chatpromo:read"]]);
            }
            return new Response("ce groupe n'existe pas");
        }
        return $this->json(['message' => 'la promo est inexistente'], Response::HTTP_NOT_FOUND);
    }




    // public function getChats( $id_promo, $id_apprenant, UserRepository $userRepository, PromoRepository $promoRepository ,ChatRepository $chatRepository)
    // {
    //     $comments=[];  
    //     $promo = $promoRepository->findOneBy(["id" => $id_promo]);
    //    // dd($promo); il m'affiche la promo
    //     if($promo){
    //         $apprenant = $userRepository->findOneBy(["id" => $id_apprenant]);
    //        // dd($apprenant); il maffiche le user
    //         foreach ($apprenant->getChats() as $chats) {
            
    //          $comments[]=$chatRepository->find($chats);
    //          //dd($comments);
    //             return $this->json($comments, 200, [], ["groups" => ["promo:read"]]);
    //         }
    //     }

    // }
















    /**
     * @Route(
     *     name="sendChat",
     *      path="api/user/promos/{id_promo}/apprenants/{id_apprenant}/chats",
     *     methods={"POST"}
     * )
     */

    // on envoit un commentaire le chat general

    public function sendChats ($id_promo, $id_apprenant, ApprenantRepository $apprenantRepository, PromoRepository $promoRepository)
    {

    }




    
}
