<?php

namespace App\Controller;

use App\Entity\Apprenant;
use App\Entity\Promo;
use App\Repository\ApprenantRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mime\Message;

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
    public function addPromo(Request $request, \Swift_Mailer $mailer, ApprenantRepository $apprenant_repo, Value $value, Message $message)
    {
//debut action
foreach($value['apprenant'] as $values){

    $Apprenant=new Apprenant();

    if($Apprenant= $apprenant_repo->findOneByEmail($values['email'])){

$message=(new\Swift_Message('Selection Sonatel Accademy '))
        ->setFrom('UsernameAdmin@gmail.com')
        ->setTo($Apprenant->getEmail())
        ->setBody('Bonjour Cher(e)'.$Apprenant->getPreom().''.$Apprenant->getNom().'
        Félicitation!!! vous avez été selectionné suite test à votre test d\'entrer à la sonatel accademy
        Veuillez utiliser ces informations pour vous connecter à votre promo. Usermane:'.$Apprenant->getUsername().
        ' Password:<<commonPassword>>. Abientot');

        $mailer->send($message;)



    }

}


//fin action
    }
        

}
