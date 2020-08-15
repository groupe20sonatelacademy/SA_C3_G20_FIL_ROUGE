<?php


namespace App\Controller\Api;


use App\Entity\Niveau;
use Doctrine\ORM\EntityManagerInterface;

class ArchivageNiveaux
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function __invoke(Niveau $data){
        $niveau = $data;

        $niveau->setArchivage(true);

        $this->em->flush();

        return $niveau;
    }
}