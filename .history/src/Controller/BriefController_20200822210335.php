<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BriefController extends AbstractController
{
    /**
     * @Route(
     *      name="Afficher_brief",               
     *         path = "/api/formateurs/briefs",
     *         methods={"GET"},
     *          defaults={ 
     *            "controller"="App/BriefController::ListerBrief",
     *            "api_resource_class"= Brief::class,
     *            "api_collection_operation_name"="Lister_Brief"
     *       }
     * )
     * 
     */
    public function ListerBrief(bri)
}
