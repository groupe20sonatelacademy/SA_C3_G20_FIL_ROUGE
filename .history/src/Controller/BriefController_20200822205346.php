<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BriefController extends AbstractController
{
    /**
     * @Route(
     *  name="brief",               
     *         path = "/api/formateurs/briefs",
     *         methods={"GET"},
     *          defaults={ 
     *            "controller"="App/BriefController::listerBrief",
     *            "api_resource_class"= Brief::class,
     *            "api_collection_operation_name"="Lister_Brief"
     *       }
     * )
     * 
     * 
     * 
     */
}
