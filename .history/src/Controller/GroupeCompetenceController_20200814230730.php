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
     *              default={ 
     *              controller=A
     *              "security_message"="Vous n'avez pas access à cette Ressource"
     *             },
     * )
     */

    public function updateGroupeCompetence(int $id, Request $request, GroupeCompetenceRepository $groupecompRepo, CompetenceRepository $compRepo)
    {
        

    }





}
