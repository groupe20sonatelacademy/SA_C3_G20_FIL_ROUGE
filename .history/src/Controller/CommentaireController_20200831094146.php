<?php

namespace App\Controller;

use App\Repository\CompetenceRepository;
use App\Repository\LivrableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CommentaireController extends AbstractController
{
    /**
     * @Route("api/formateur/livrablePartiel/{id}/commentaire", name="addCommentaire",methods={"post"})
     */
    public function addCommentaire(int $id,LivrablePartielRepository $livrableRenduRepository,
    CompetenceRepository $competenceRepository)
    {
        $livPartiel=$li
    }


}
