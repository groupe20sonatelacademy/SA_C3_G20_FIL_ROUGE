<?php

namespace App\Controller;

use App\Repository\CompetenceRepository;
use App\Repository\GroupeCompetenceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GroupeCompetenceController extends AbstractController
{
    /**
     * @Route("/groupe/competence", name="groupe_competence")
     */
    public function index()
    {
        return $this->render('groupe_competence/index.html.twig', [
            'controller_name' => 'GroupeCompetenceController',
        ]);
    }

    /*--------------------edition competences et tags dans groupecompetence-----------------------*/
    /**
     * @Route( 
     *           name="Edition_competence_in_groupecompetence"
     *               "method"={"put"},
     *              "path" = "/api/admin/groupecompetences/{id}",
     *              defaults={ 
     *              "controller"="Api/GroupeCompetenceController::updateGroupeCompetence",
     *             "api_resource_class"="GroupeCompetence::class",
     *              "api_item_operation_name"="updateGroupeCompetence"
     *             }
     * )
     */

    public function updateGroupeCompetence(int $id, Request $request, GroupeCompetenceRepository $groupecompRepo, CompetenceRepository $compRepo)
    {
        //on recuprere le groupe de competence a partir de l'id
        $groupecompetence= $groupecompRepo->find($id);
         
        // on recupere les information de la requete
        

    }





}
