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

        //On récupère les informations de la requête
        $groupeCompetenceTab = json_decode($request->getContent(), true);

        //Si le libelle est modifié
        if (!empty($groupeCompetenceTab['libelle'])) {
            $groupe_competence = new GroupeCompetence();
            $groupe_competence->setLibelle($groupeCompetenceTab['libelle']);
        }

        //Edition d'une compétence
        if (!empty($groupeCompetenceTab['updateCompetences'])) {
            foreach ($groupeCompetenceTab['updateCompetences'] as $updateElement) {
                //Modification d'une compétence
                if (!empty($updateElement)) {
                    //Modifier compétences
                    if (isset($updateElement['id']) && isset($updateElement['libelle']) && isset($updateElement['descriptif']) && !isset($updateElement['archivage'])) {
                        //On parcourt l'ensemble des compétences
                        foreach ($groupeCompetence->getCompetence() as $compet) {
                            //On récupère la compétence correspondante
                            if ($compet->getId() == $updateElement['id']) {
                                //On modifie le libelle
                                $comp->setLibelle($updateElement['libelle']);
                                $comp->setDescriptif($updateElement['descriptif']);
                            }
                        
                        }

                    } elseif (!isset($updateElement['id']) && isset($updateElement['libelle']) && isset($updateElement['descriptif']) && isset($updateElement['archivage'])) {
                        //Ajout de compétences
                        $competence = new Competence();

                        $competence->setLibelle($updateElement['libelle']);
                        $competence->setDescriptif($updateElement['descriptif']);
                        $competence->setArchivage($updateElement['archivage']);

                        $groupeCompetence->addCompetence($competence);
                    } elseif (isset($updateElement['id']) && !isset($updateElement['libelle']) && !isset($updateElement['descriptif']) && !isset($updateElement['archivage'])) {
                        //Suppression competence
                        foreach ($groupeCompetence->getCompetence() as $comp) {
                            if ($comp->getId() === $updateElement['id']) {
                                $comp->setArchivage(true);
                                $groupeCompetence->removeCompetence($comp);
                        
                            }
                        
                        }

                    }
                }
            }  
        }

        $this->manager->flush();

        return $this->json($groupeCompetence, Response::HTTP_OK);

    }

}
