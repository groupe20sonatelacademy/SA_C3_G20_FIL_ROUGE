<?php

namespace App\Controller;

use App\Entity\Competence;
use App\Entity\GroupeCompetence;
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

    //--------------------edition competences et tags dans groupecompetence-----------------------
    /**
     * @Route( 
     *           name="Edition_competence_in_groupecompetence",
     *               
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
        $groupecompetenceTab = json_decode($request->getContent(), true);

        //Si le libelle est modifié
        if(!empty ($groupecompetenceTab['libelle'])){
            $groupecompetence=new GroupeCompetence();
            $groupecompetence->setLibelle($groupecompetenceTab(['libelle']));

        }

        //edition d'une copetence
        if(!empty($groupecompetenceTab['updateCompetence'] )){

        }
        if (!empty($groupecompetenceTab['updateCompetence'][0]== "competence")) {

            foreach($groupecompetenceTab['updateCompetence'] as $updateElement){

                //modification d'une copetence
                if(!empty($updateElement)){

                    if(isset($updateElement['id']) && isset($updateElement['libelle']) && isset($updateElement['descriptif'])){
                        // on parcours l'ensemble des competences
                        foreach($groupecompetence->getCompetence() as $compet){
                            //on recupere la compence corespondance
                            if($compet->getId()==$updateElement['id']){
                                // on modifie le libelle
                                $compet->setLibelle($updateElement['libelle']);
                                $compet->setDescriptif($updateElement['descriptif']);
                            }
                        }

                    }elseif(!isset($updateElement['id']) && isset($updateElement['libelle']) && isset($updateElement['descriptif']) && isset($updateElement['archivage'])){
                        //on ajoute une competence
                        $competence=new Competence();
                        $competence->setLibelle($updateElement['libelle']);
                        $competence->setDescriptif($updateElement['descriptif']);
                        $competence->setArchivage($updateElement['archivage']);

                        $groupecompetence->addCompetence($competence);

                    } elseif(isset($updateElement['id']) && !isset($updateElement['libelle']) && !isset($updateElement['descriptif'])&& isset($updateElement['archivage'])){
                        // suppression competence
                        foreach ($groupecompetence->getCompetence() as $compet) {
                            if ($compet->getId() == $updateElement['id']) {
                                $compet->setArchivage(1);
                                
                                $groupecompetence->removeCompetence($compet);
                               
                            }
                        }
                    }
                }
            }
        }
        

    }





}
