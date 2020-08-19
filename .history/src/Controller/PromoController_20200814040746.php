<?php

namespace App\Controller;

use App\Entity\Apprenant;
use App\Entity\Promo;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PromoController extends AbstractController
{
    /**
     * Undocumented variable
     * 
     * @var EntityManagerInterface
     */
  /*  public function addFormateurByUsername(string $username, int $id, UserRepository $userRepository, EntityManagerInterface $manager, Request $request)
    {

        $user= $userRepository->findOneBy(["username" => $username]);

        $manager->persist($user);

        $manager->flush();
        

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

  }*/
    public function addPromo(Request $request, \Swift_Mailer $mailer)
    {
//debut action
foreach($value['apprenant'] as $key=> $values){

    $apprenant=new Apprenant();
    if()

}


//fin action
    }
        

}
