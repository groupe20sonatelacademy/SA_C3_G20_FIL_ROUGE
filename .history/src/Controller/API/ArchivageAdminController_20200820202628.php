<?php

namespace App\Controller\API;

use App\Entity\Admin;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ArchivageAdminController extends AbstractController
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

    // fonction qui permet de modifier l'archivage de
    public function __invoke(Admin $data)
    {
        $data->setArchivage(1);
        $this->manager->flush();
        return $data;
    }
}