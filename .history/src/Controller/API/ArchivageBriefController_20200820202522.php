<?php

namespace App\Controller\API;

use App\Entity\Brief;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArchivageBriefController extends AbstractController
{
    /**
     * Undocumented variable
     * 
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {

        $this->manager = $manager;
    }

    // fonction qui permet de modifier l'archivage du profil
    public function __invoke(Brief $data)
    {
        $data->setArchivage(1);
        $this->manager->flush();
        return $data;
    }
}
