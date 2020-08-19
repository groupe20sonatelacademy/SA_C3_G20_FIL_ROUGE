<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ArchivageProfilController extends AbstractController
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


    public function __invoke(P $data)
    {
        $data->setArchivage(0);
        $this->manager->flush();
        return $data;
    }
}
