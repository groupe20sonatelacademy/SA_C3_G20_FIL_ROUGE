<?php


namespace App\Controller\Api;


use App\Entity\Tags;
use Doctrine\ORM\EntityManagerInterface;

class ArchivageTags
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function __invoke(Tags $data){
        $tags = $data;

        $tags->setArchivage(true);

        $this->em->flush();

        return $tags;
    }
}