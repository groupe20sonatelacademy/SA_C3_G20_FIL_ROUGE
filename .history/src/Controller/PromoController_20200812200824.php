<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PromoController extends AbstractController
{
    $promo = $entityManager->getRepository(promotion::class)->find($id);

        $reponse=json_decode($request->getContent(),true);
        $action=$reponse['action'];
        $tableau=['username','email'];
for ($i = 0; $i < count($tableau); $i++) {

    if (isset($reponse[$tableau[$i]])) {
        $user = $reponse[$tableau[$i]];
        $userId = $userRepository->findOneBy([$tableau[$i] => $user]);
        $idProfil = $userId->getProfil()->getId();

        if ($idProfil == 4) {

            $promo->addFormateur($userId);
       }
    }

    { }
}
