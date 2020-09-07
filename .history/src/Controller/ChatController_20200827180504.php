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


    public function getChats( $id_promo, $id_apprenant, UserRepository $userRepository, PromoRepository $promoRepository ,ChatRepository $chatRepository)
     {
    //     $comments=[];  
    //     $promo = $promoRepository->findOneBy(["id" => $id_promo]);
    //    //dd($promo); //il m'affiche la promo
    //     if($promo){
    //         $apprenant = $userRepository->findOneBy(["id" => $id_apprenant]);
    //        // dd($apprenant);// il maffiche le user
    //         foreach ($apprenant as $apprenants) {
    //         if ($apprenants== $id_apprenant) {
    //            // dd($apprenants);
    //                break;
    //           }
    //             // $comments[]=$chatRepository->find($chats);
    //             //dd($comments);
    //             // return $this->json($comments, 200, [], ["groups" => ["promoChat:read"]]);
    //       $apprenants = null;
    //         }
            
    //     }

    }
















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
