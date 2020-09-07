<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Repository\ApprenantRepository;
use App\Entity\LivrablePartielApprenant;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\FilDiscussionRepository;
use App\Repository\LivrablePartielRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use App\Repository\LivrablePartielApprenantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommentaireController extends AbstractController
{
    /**
     * @Route("api/apprenants/livrablePartiels/{id}/commentaires", name="addCommentaire",methods={"post"})
     */
// Ajout dun fils de discussion et commentaire dans un livrable partiel

    public function addCommentaire(int $id,LivrablePartielRepository $livrablePartielRepository,
        Request $request, Security $security,
        ApprenantRepository $apprenantRepository,
        EntityManagerInterface $em,
        FilDiscussionRepository $filDiscussionRepository)
    {
        $content = json_decode($request->getContent(), true);

        $livrablePartiel = $livrablePartielRepository->find($id);
        dd($content);
        $apprenant=$apprenantRepository->fin((int)$content["idApprenant"]);

  //TODO: Recuperation du fil de discussion du livrable partiel
                   //collection livrable partiel
        $livApprenant = $livrablePartiel->getLivrablePartielApprenants();

foreach ($livApprenant as  $livApprenants) {
    //on recupere livApprenant correspondant
    if($livApprenants->getApprenant()===$apprenant){
         //on recupere la fil de dicussion
$fildiscussion=$filDiscussionRepository->findBy(
    ["livrablePartielApprenant"=> $livApprenants->getId()]);
    
    // TODO: creation et enregistrement du commentaitre
    $commentaire=new Commentaire();
    $commentaire->setDescription($content["description"]);
    $commentaire->setDateCreation($content["dateCreation"]);
    $commentaire->setFildiscussion($fildiscussion[0]);
    //ajout de l'apprenant
    $apprenants=$security->getUser();
//dd($apprenants);


    }
}



        //return $this->json($livApprenant);ppp
    //     $content = $request->request->all();
    //    // return $this->json($content);mplo
    //     $commentaire = $serializer->denormalize($content, "App\Entity\Commentaire", true);
    //     //return $this->json($commentaire);
       

if ($livPartiel) {
    foreach ($livApprenant as $value) {
        if ($value) {
          // return $this->json($value);
            $commentaire->setFildiscussion($value);
                        


                        
                    $em->persist($commentaire);
                    $em->flush();

                    return $this->json("succes", 201);
        }
    }
}







    }


}