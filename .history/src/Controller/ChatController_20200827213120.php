<?php

namespace App\Controller;

use App\Repository\ChatRepository;
use App\Repository\UserRepository;
use App\Repository\PromoRepository;
use App\Repository\ApprenantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
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


    public function getChats( $id_promo, $id_apprenant,
     PromoRepository $promoRepository ,
     ChatRepository $chatRepository,
    ApprenantRepository $apprenantRepository)
    {
   $tabChat=[];
    $promo = $promoRepository->find($id_promo);
       $apprenant = $apprenantRepository->find($id_apprenant);
        //dd($apprenant);uyuyuuyuy
        $groupe = $promo->getGroupe();

        if($promo){
            
            foreach ($groupe as  $groupes) {
                $apprenants=$groupes->getApprenant();
                //return $this->json($apprenants);iio
                foreach ($apprenants as $value) {
                    if ($value == $apprenant) {
                        $tabChat[] = $value->getChats();

                        return $this->json($tabChat, 200);
                    }
                }
            }


         }
        return $this->json("cette promotion n'existe pas !!", 400);
 
    }












    //    //dd($promo); //il m'affiche la promo
    //     if($promo){
    //         $apprenant = $userRepository->findOneBy(["id" => $id_apprenant]);
    //        // dd($apprenant);// il maffiche le user
    //         foreach ($apprenant->getChats() as $chats) {
    //          $comments[]=$chatRepository->find($chats);
    //          dd($comments);
    //             return $this->json($comments, 200, [], ["groups" => ["promoChat:read"]]);
    //         }
        

    
















    /**
     * @Route(
     *     name="sendChat",
     *      path="api/user/promos/{id_promo}/apprenants/{id_apprenant}/chats",
     *     methods={"POST"}
     * )
     */

    // on envoit un commentaire le chat general

    public function sendChats ($id_promo, $id_apprenant,
     ApprenantRepository $apprenantRepository, 
     PromoRepository $promoRepository,
     Request $request,
    SerializerInterface $serializer,
        EntityManagerInterface $em
     )
    {

        $promo = $promoRepository->find($id_promo);
        $apprenant = $apprenantRepository->find($id_apprenant);
        //dd($apprenant);uyuyuuyuy
        $groupe = $promo->getGroupe();

        $content = $request->request->all();
        $chat = $serializer->denormalize($content, "App\Entity\Chat", true);

        if ($promo) {

            foreach ($groupe as  $groupes) {
                $apprenants = $groupes->getApprenant();
                //return $this->json($apprenants);iio

                foreach ($apprenants as $value) {
                    if ($value == $apprenant) {
                        $chat = $value->setApprenant();

                        $em->persist($chat);
                        $em

                        return $this->json("succes", 201);
                    }
                }
            }
        }

        
    }




    
}
