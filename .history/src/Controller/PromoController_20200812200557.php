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
    
}
