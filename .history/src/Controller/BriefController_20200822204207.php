<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BriefController extends AbstractController
{
    /**
     * @Route(
     *  name="edition_competence_in_groupecompetence",               
     *         path = "/api/admin/groupecompetences/{id}",
     *         methods={"put"},
     *          defaults={ 
     *            "controller"="App/GroupeCompetenceController::updateGroupeCompetence",
     *            "api_resource_class"= GroupeCompetence::class,
     *            "api_item_operation_name"="update_groupe_competence"
     * )
     * 
     * 
     * 
     */
}