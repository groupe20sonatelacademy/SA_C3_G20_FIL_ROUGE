<?php

namespace App\Controller;

use App\Entity\Promo;
use App\Entity\Apprenant;
use Symfony\Component\Mime\Message;
use App\Repository\ApprenantRepository;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\Expr\Value;
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
    public function addPromo( \Swift_Mailer $mailer, ApprenantRepository $apprenantRepository, Value $value)
    {
//debut action
foreach($value['apprenant'] as $values){


    if($Apprenant= $apprenantRepository->findOneByEmail($values['email'])){

$result= (new\Swift_Message('Selection Sonatel Accademy'))
        ->setFrom('usernameAdmin@gmail.com')
        ->setTo($Apprenant->getEmail())
        ->setBody('Bonjour Cher(e)'.$Apprenant->getPreom().''.$Apprenant->getNom().
        ' Félicitation!!! vous avez été selectionné suite  à votre test d\'entrer à la sonatel accademy
        Veuillez utiliser ces informations pour vous connecter à votre promo. Usermane:'.$Apprenant->getUsername().
        'Password:<<commonPassword>>. A bientot.');
    

        $mailer->send($result);



    }

}
    //fin action

    //---------------------debut action--------------------
    public function addTest(Request $request)
   * {

        $doc = $request->files->get("document");

        $file= IOFactory::identify($doc);
        
        $reader= IOFactory::createReader($file);

        $spreadsheet=$reader->load($doc);
        
        $array_contenu_fichier= $spreadsheet->getActivesheet()->toArray();
        
        return $this->json($array_contenu_fichier,201);
    }*
//------------------------fin action-------------------
    }
        

}
