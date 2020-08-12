<?php


namespace App\Controller\Api;
use App\Entity\ProfilsDeSortie;
use Doctrine\ORM\EntityManagerInterface;

class ArchivageProfilsDeSorties
{
    //On injecte l'entity em

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function __invoke(ProfilsDeSortie $data)
    {
        //On récupèrer le profil de sortie en cours de traitement
        $profilsDeSorties = $data;

        //On change le statut de l'archivage
        $profilsDeSorties->setArchivage(true);
        //On renvoi l'élement dans la BD
        $this->em->flush();

        return $profilsDeSorties;
    }

}