<?php

namespace App\Controller;

use App\Repository\CompetenceRepository;
use App\Repository\LivrablePartielRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CommentaireController extends AbstractController
{
    /**
     * @Route("api/formateur/livrablePartiel/{id}/commentaire", name="addCommentaire",methods={"post"})
     */
// A

    public function addCommentaire(int $id,LivrablePartielRepository $livrablePartielRepository,
    CompetenceRepository $competenceRepository)
    {
        $livPartiel = $livrablePartielRepository->fin($id);

    }


}
