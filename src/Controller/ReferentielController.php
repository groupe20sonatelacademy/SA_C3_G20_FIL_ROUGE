<?php

namespace App\Controller;

use App\Entity\Competences;
use App\Repository\CompetencesRepository;
use App\Repository\ReferentielRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Referentiel;

class ReferentielController extends AbstractController
{

    private $em;

    /**
     * @Route("/referentiel", name="referentiel")
     */
    public function index()
    {
        return $this->render('referentiel/index.html.twig', [
            'controller_name' => 'ReferentielController',
        ]);
    }

    /**
     * ReferentielController constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @Route(
     *     name="edition_referentiel",
     *     path="/api/admin/referentiels/{id}",
     *     methods={"PUT"},
     *     defaults={
     *          "_controller" = "App\ReferentielController::updateReferentiel",
     *          "_api_resource_class" = Referentiel::class,
     *          "_api_item_operation_name" = "update_referentiel"
     *     }
     * )
     */
    public function updateReferentiel(int $id,Request $request, ReferentielRepository $referentielRepository, CompetencesRepository $competencesRepository)
    {
        //On récupère le référentiel
        $referenciel = $referentielRepository->find($id);

        //On récupère le content de la requête
        $referencielTab = json_decode($request->getContent(),true);

        //On gère la modification  des infos de base du référentiel
        if(!empty($referencielTab['libelle'])){
            $ref = new Referentiel();
            $ref->setLibelle($referencielTab['libelle']);
        }
        if(!empty($referencielTab['critereEvalutation'])){
            $ref = new Referentiel();
            $ref->setCritereEvaluation($referencielTab['critereEvalutation']);
        }
        if(!empty($referencielTab['programme'])){
            $ref = new Referentiel();
            $ref->setProgramme($referencielTab['programme']);
        }
        if(!empty($referencielTab['critereAdmission'])){
            $ref = new Referentiel();
            $ref->setCritereAdmission($referencielTab['critereAdmission']);
        }
        //On gère la modification d'une compétence dans le référentiel
        if(!empty($referencielTab['updateCompetences'])){
            foreach ($referencielTab['updateCompetences'] as $updateCompetence){
                if(!empty($updateCompetence)){
                    if(isset($updateCompetence['id']) && isset($updateCompetence['libelle']) && !isset($updateCompetence['archivage'])){
                        //On parcours l'ensemble des compétences du référentiel
                        foreach ($referenciel->getCompetences() as $competence) {
                            if($competence->getId() == $updateCompetence['id']){
                                $competence->setLibelle($updateCompetence['libelle']);
                                $competence->setDescriptif($updateCompetence['descriptif']);
                            }
                        }
                    }elseif(!isset($updateCompetence['id']) && isset($updateCompetence['libelle']) && isset($updateCompetence['descriptif'])){
                        //Ajout de compétence
                        $competence = new Competences();
                        $competence->setLibelle($updateCompetence['libelle']);
                        $competence->setDescriptif($updateCompetence['descriptif']);
                        $competence->setArchivage($updateCompetence['archivage']);
                    }elseif(isset($updateCompetence['id']) && !isset($updateCompetence['libelle']) && !isset($updateCompetence['descriptif'])){
                        //Suppression d'une compétence
                        foreach ($referenciel->getCompetences() as $competence) {
                            if($competence->getId() == $updateCompetence['id']){
                                $competence->setArchivage(false);
                                $referenciel->removeCompetence($competence);
                            }
                        }
                    }
                }
            }
        }

        $this->em->flush();

        return $this->json($referenciel,Response::HTTP_OK);

    }
}
