<?php

namespace App\Controller;

use App\Repository\CompetenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\LivrablePartielRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommentaireController extends AbstractController
{
    /**
     * @Route("api/formateurs/livrablePartiels/{id}/commentaires", name="addCommentaire",methods={"post"})
     */
// Ajout dun fils de discussion et commentaire dans un livrable partiel

    public function addCommentaire(int $id,LivrablePartielRepository $livrablePartielRepository,
        Request $request,
        SerializerInterface $serializer,
        EntityManagerInterface $em)
    {
        $livPartiel = $livrablePartielRepository->find($id);
        $livApprenant= $livPartiel->getLivrablePartielApprenants();

        //return $this->json($livApprenant);ppp
        $content = $request->request->all();
       // return $this->json($content);mplo
        $commentaire = $serializer->denormalize($content, "App\Entity\Commentaire", true);
        //return $this->json($commentaire);
       

if ($livPartiel) {
    foreach ($livApprenant as $value) {
        if ($value) {
           return($value);
            $commentaire->setFildiscussion($value);
                    $em->persist($commentaire);
                    $em->flush();

                    return $this->json("succes", 201);
        }
    }
}







    }


}
