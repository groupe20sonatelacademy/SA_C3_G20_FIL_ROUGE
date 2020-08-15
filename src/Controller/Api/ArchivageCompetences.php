<?php


namespace App\Controller\Api;


use App\Entity\Competences;
use Doctrine\ORM\EntityManagerInterface;

class ArchivageCompetences
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        //On fait appel à notre manager
        $this->em = $entityManager;
    }


    //Récupérer la ressource
    public function __invoke(Competences $data)
    {
        $competence = $data;

        //Modifier la ressource
        $competence->setArchivage(true);

        //Renvoyer la ressource
        $this->em->flush();

        return $competence;
    }

}