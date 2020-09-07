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
use Symfony\Component\HttpFoundation\JsonResponse;
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
   $commentaire=[];
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
                        $commentaire[] = $value->getChats();

                        return $this->json($commentaire, 200);
                    }
                }
            }


         }
        return $this->json("cette promotion n'existe pas !!", 400);
 
    }

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
    
     EntityManagerInterface $em )
    {

        $promo = $promoRepository->find($id_promo);
        $apprenant = $apprenantRepository->find($id_apprenant);
        //dd($apprenant);uyuyuuyuy
        $groupe = $promo->getGroupe();

        $content = $request->request->all();
        $chat=$serializer->denormalize($content, "App\Entity\Chat", true);


        // $piecejoint = $request->files->get("pieceJoint");
        // if (!$piecejoint) {
        //     return new JsonResponse("veuillez mettre une images", Response::HTTP_BAD_REQUEST, [], true);
        // }
        // $photoBlob = fopen($piecejoint->getRealPath(), "rb");

        // $chat->setPieceJoint($photoBlob);


        if ($promo) {

            foreach ($groupe as  $groupes) {
                $apprenants = $groupes->getApprenant();
                //return $this->json($apprenants);iio

                foreach ($apprenants as $value) {
                    if ($value == $apprenant) {
                       $chats= $chat->setApprenant($value);
             //return $this->json($chats);
                        $em->persist($chats);
                        $em->flush();

                        return $this->json("succes", 201);
                    }
                }
            }
        }

        
    }




    
}
