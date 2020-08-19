<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class FormateurController extends AbstractController
{
   
   /**
     * @var EntityManagerInterface
     * L'encodeur de mot de pass
     */
    protected $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
        
    }
 $manager->persist($formateur);

        $manager->flush();
}
