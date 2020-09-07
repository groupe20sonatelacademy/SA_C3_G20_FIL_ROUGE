<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CommentaireController extends AbstractController
{
    /**
     * @Route("api/formateur/livrablePartiel/{id}/commentaire", name="addCommentaire",methods={"post"})
     */
    public function addCommentaire(int $id)
    {
        
    }
}
