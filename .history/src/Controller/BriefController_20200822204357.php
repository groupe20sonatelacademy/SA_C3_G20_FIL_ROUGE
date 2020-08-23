<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BriefController extends AbstractController
{
    /**
     * @Route(
     *  name="lister_brief",               
     *         path = "/api/formateurs/briefs",
     *         methods={"GET"},
     *          defaults={ 
     *            "controller"="App/BriefController::iewBrief",
     *            "api_resource_class"= GroupeCompetence::class,
     *            "api_item_operation_name"="update_groupe_competence"
     * )
     * 
     * 
     * 
     */
}
