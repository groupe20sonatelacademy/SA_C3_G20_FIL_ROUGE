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
                                $compet->setLibelle($updateElement['libelle']);
                                $compet->setDescriptif($updateElement['descriptif']);
                                
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
                        foreach ($groupeCompetence->getCompetence() as $compet) {
                            if ($compet->getId() === $updateElement['id']) {
                                $compet->setArchivage(true);
                                $groupeCompetence->removeCompetence($compet);
                                
                            }
                        
                        }

                    }
                }
            }  
        if (!empty($groupecompetenceTab['updateTags'])) {
            //On vérifie si les tags sont concernés par la modification
            foreach ($groupecompetenceTab['updateTags'] as $updateTags) {
                if (!empty($updateTags)) {
                    //Modification d'un tag
                    if (isset($updateTags['id']) && isset($updateTags['descriptif']) && !isset($updateTags['archivage'])) {
                        //Parcours le tableau des tags
                        foreach ($groupecompetence->getTags() as $tags) {
                            //On vérifie les id
                            if ($tags->getId() == $updateTags['id']) {
                                $tags->setlibelle($updateTags['libelle']);
                                $tags->setDescriptif($updateTags['descriptif']);
                            }
                        }
                    } elseif (isset($updateTags['id']) && !isset($updateTags['libelle']) && !isset($updateTags['descriptif']) && !isset($updateTags['archivage'])) {
                        //Archivage des tags
                        foreach ($groupecompetence->getTags() as $tags) {
                            if ($tags->getId() == $updateTags['id']) {
                                $tags->setArchivage(true);

                                $groupecompetence->removeTag($tags);
                            }
                        }
                    }
                }
            }
        }*
}

        $this->manager->flush();

        return $this->json($groupeCompetence, Response::HTTP_OK);

    }

}