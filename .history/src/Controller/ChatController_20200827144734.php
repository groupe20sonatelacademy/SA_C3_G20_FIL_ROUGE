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
     *     methods="GET"
     * )
     */
    
    /**
     * @Route(
     *    name="getProfilsortieAndApprenant",
     *     path="api/admin/profilsorties/{id}",
     *      methods={"GET"}
     *     )
     */

    public function getPromoBrief(BriefRepository $briefRepository, PromoRepository $promoRepository, $id)
    {

    }
















    /**
     * @Route(
     *     name="sendChat",
     *      path="api/user/promos/{id_promo}/apprenant/{id_apprenant}/chats",
     *     methods="POST"
     * )
     */






    
}
