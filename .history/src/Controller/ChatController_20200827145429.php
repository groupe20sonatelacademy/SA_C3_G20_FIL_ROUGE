<?php

namespace App\Controller;

use App\Repository\ApprenantRepository;
use App\Repository\PromoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ChatController extends AbstractController
{
    /**
     * @Route(
     *     name="getChats",
     *      path="api/user/promos/{id_promo}/apprenant/{id_apprenant}/chats",
     *     methods={"GET"}
     * )
     */
// On recupere les commenttaire pas jour
    public function getChats( $id_promo, $id_apprenant, ApprenantRepository $apprenantRepository, PromoRepository $promoRepository)
    {

    }
















    /**
     * @Route(
     *     name="sendChat",
     *      path="api/user/promos/{id_promo}/apprenant/{id_apprenant}/chats",
     *     methods={"POST"}
     * )
     */

// on envoit un commentaire le chat general




    
}