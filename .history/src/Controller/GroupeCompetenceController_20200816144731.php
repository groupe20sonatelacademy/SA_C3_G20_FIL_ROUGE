<?php

namespace App\Controller;

use App\Entity\Competence;
use App\Entity\GroupeCompetence;
use App\Repository\CompetenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\GroupeCompetenceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GroupeCompetenceController extends AbstractController
{
    
/**
* @var EntityManagerInterface
*/
    private $manager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->manager = $entityManager;
    }


    /**
     * @Route("/groupe/competence", name="groupe_competence")
     */
    /*public function index()
    {
        return $this->render('groupe_competence/index.html.twig', [
            'controller_name' => 'GroupeCompetenceController',
        ]);
    }*/

    //--------------------edition competences et tags dans groupecompetence-----------------------
    /**
     * @Route( 
     *         name="edition_competence_in_groupecompetence",               
     *         path = "/api/admin/groupecompetences/{id}",
     *         methods={"put"},
     *          defaults={ 
     *            "controller"="App/GroupeCompetenceController::updateGroupeCompetence",
     *            "api_resource_class"= GroupeCompetence::class,
     *            "api_item_operation_name"="update_groupe_competence"
     *          },
     * )
     */

    public function updateGroupeCompetence(int $id, Request $request, GroupeCompetenceRepository $grcrepo, CompetenceRepository $crepo)
    {
        //On récupère le groupe de compétence à partir de l'ID
        $groupeCompetence = $grcrepo->find($id);






        
     $this->manager->flush();

     return $this->json($groupeCompetence, Response::HTTP_OK);

    }

}
