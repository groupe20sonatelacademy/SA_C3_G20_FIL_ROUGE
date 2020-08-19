<?php

namespace App\Controller\API;

use App\Entity\Formateur;
use App\Entity\GroupeCompetence;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ArchivageFormateurController extends AbstractController
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
    public function __invoke(GroupeCompetence $data)
    {
        $data->setArchivage(1);
        $this->manager->flush();
        return $data;
    }
}
