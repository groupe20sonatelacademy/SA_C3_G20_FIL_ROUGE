<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\PromoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
    public function getChats( $id_promo, $id_apprenant, UserRepository $userRepository, PromoRepository $promoRepository Chat)
    {
        $comments=[];  
        $promo = $promoRepository->findOneBy(["id" => $id_promo]);
       // dd($promo); il m'affiche la promo
        if($promo){
            $apprenant = $userRepository->findOneBy(["id" => $id_apprenant]);
           // dd($apprenant); il maffiche le user
            foreach ($apprenant->getChats() as $chats) {
            
             $comments[]=$userRepository->find($chats);
             dd($comments);            
               
            }
        }

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
