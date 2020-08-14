<?php

namespace App\Controller;

use App\Repository\CompetenceRepository;
use App\Repository\CompetencesRepository;
use App\Repository\GroupeCompetencesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\GroupeCompetences;
use App\Entity\Competences;

class GroupeCompetenceController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @Route("/groupe/competence", name="groupe_competence")
     */
    public function index()
    {
        return $this->render('groupe_competence/index.html.twig', [
            'controller_name' => 'GroupeCompetenceController',
        ]);
    }

    /**
     * @Route(
     *     name="edition_competence_in_grpe_competence",
     *     path="/api/admin/groupe_competences/{id}",
     *     methods={"PUT"},
     *     defaults={
     *          "_controller" = "App\GroupeCompetenceController::updateGroupeCompetence",
     *          "_api_resource_class" = GroupeCompetences::class,
     *          "_api_item_operation_name" = "update_groupe_competence"
     *     }
     * )
     */
    public function updateGroupeCompetence(int $id, Request $request, GroupeCompetencesRepository $grcrepo, CompetencesRepository $crepo)
    {
        //On récupère le groupe de compétence à partir de l'ID
        $groupeCompetence = $grcrepo->find($id);

        //On récupère les informations de la requête
        $groupeCompetenceTab = json_decode($request->getContent(), true);

        //Si le libelle est modifié
        if (!empty($groupeCompetenceTab['libelle'])) {
            $groupe_competence = new GroupeCompetences();
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
                        foreach ($groupeCompetence->getCompetences() as $comp) {
                            //On récupère la compétence correspondante
                            if ($comp->getId() == $updateElement['id']) {
                                //On modifie le libelle
                                $comp->setLibelle($updateElement['libelle']);
                                $comp->setDescriptif($updateElement['descriptif']);
                            }
                        }
                    } elseif (!isset($updateElement['id']) && isset($updateElement['libelle']) && isset($updateElement['descriptif']) && isset($updateElement['archivage'])) {
                        //Ajout de compétences
                        $competence = new Competences();

                        $competence->setLibelle($updateElement['libelle']);
                        $competence->setDescriptif($updateElement['descriptif']);
                        $competence->setArchivage($updateElement['archivage']);

                        $groupeCompetence->addCompetence($competence);

                    }elseif(isset($updateElement['id']) && !isset($updateElement['libelle']) && !isset($updateElement['descriptif']) && !isset($updateElement['archivage'])){
                        //Suppression competence
                        foreach ($groupeCompetence->getCompetences() as $comp){
                            if($comp->getId() === $updateElement['id']){
                                $comp->setArchivage(true);
                                $groupeCompetence->removeCompetence($comp);
                            }
                        }
                    }
                }
            }
        }
        if(!empty($groupeCompetenceTab['updateTags'])){
            //On vérifie si les tags sont concernés par la modification
            foreach ($groupeCompetenceTab['updateTags'] as $updateTags){
                if(!empty($updateTags)){
                    //Modification d'un tag
                    if(isset($updateTags['id']) && isset($updateTags['descriptif']) && !isset($updateTags['archivage'])){
                        //Parcours le tableau des tags
                        foreach ($groupeCompetence->getTags() as $tags){
                            //On vérifie les id
                            if($tags->getId() == $updateTags['id']){
                                $tags->setlibelle($updateTags['libelle']);
                                $tags->setDescriptif($updateTags['descriptif']);
                            }
                        }
                    }elseif (isset($updateTags['id']) && !isset($updateTags['libelle']) && !isset($updateTags['descriptif']) && !isset($updateTags['archivage'])){
                        //Archivage des tags
                        foreach ($groupeCompetence->getTags() as $tags){
                            if($tags->getId() == $updateTags['id']){
                                $tags->setArchivage(true);

                                $groupeCompetence->removeTag($tags);
                            }
                        }
                    }
                }
            }
        }

        $this->em->flush();

        return $this->json($groupeCompetence, Response::HTTP_OK);

    }
}
