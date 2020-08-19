<?php

namespace App\Controller;

use App\Entity\Promo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
     * @var EntityManagerInterface
     * L'encodeur de mot de pass
     */
    pr $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
        
    }

class PromoController extends AbstractController
{
    
            

            $promo = $manager->getRepository(promo::class)->find($id);

                $reponse=json_decode($request->getContent(),true);
                $action=$reponse['action'];
                $tableau=['username','email'];
        for ($i = 0; $i < count($tableau); $i++) {

            if (isset($reponse[$tableau[$i]])) {
                $user = $reponse[$tableau[$i]];
                $userId = $userRepository->findOneBy([$tableau[$i] => $user]);
                $idProfil = $userId->getProfil()->getId();

                if ($idProfil == 2) {

                    $promo->addFormateur($userId);
                }
            }

        }

 

        

}
