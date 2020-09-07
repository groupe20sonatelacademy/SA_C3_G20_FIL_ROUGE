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
    public function getChats( $id_promo, $id_apprenant, UserRepository $userRepository, PromoRepository $promoRepository)
    {
        $comments=[];  
        $promo = $promoRepository->findOneBy(["id" => $id_promo]);
       // dd($promo);
        if($promo){
            foreach ($promo->getChats() as  $chats) {
               if($chats->getUser()==$id_apprenant){
$comments[]=$userRepository->find($id_apprenant)
               }
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
