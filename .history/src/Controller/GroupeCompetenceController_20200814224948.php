<?php

namespace App\Controller;

use App\Repository\CompetenceRepository;
use App
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


    public function UpdateGroupeCompetence(int $id, Request $request, groupecompetenceRepository $groupecompRepo,CompetenceRepository $compRepo)
    {
        
    }





}
