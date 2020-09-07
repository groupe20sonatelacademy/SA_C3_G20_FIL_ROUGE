<?php

namespace App\Controller;

use App\Repository\CompetenceRepository;
use App\Repository\LivrablePartielRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CommentaireController extends AbstractController
{
    /**
     * @Route("api/formateurs/livrablePartiels/{id}/commentaires", name="addCommentaire",methods={"post"})
     */
// Ajout dun fils de discussion et commentaire dans un livrable partiel

    public function addCommentaire(int $id,LivrablePartielRepository $livrablePartielRepository,
    CompetenceRepository $competenceRepository)
    {
        $livPartiel = $livrablePartielRepository->find($id);

        //return $this->json($livPartiel);mm
        $livParApprenant=$
    }


}
