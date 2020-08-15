<?php


namespace App\Controller\Api;


use App\Entity\GroupeCompetences;
use Doctrine\ORM\EntityManagerInterface;

class ArchivageGrpeCompetences
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }

    public function __invoke(GroupeCompetences $data){
        $grpecompetence = $data;

        $grpecompetence->setArchivage(true);

        $this->em->flush();

        return $grpecompetence;
    }
}