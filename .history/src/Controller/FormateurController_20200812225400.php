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
   

        public function addFormateurByUsername(string $username, formateurRepository $formateurRepository)
        {
                protected $manager;

                public function __construct(EntityManagerInterface $manager)
                {
                    $this->manager = $manager;
                }
            
            $formateur = $formateurRepository->findOneBy(["username" => $username]);

             $manager->persist($formateur);
             
             $manager->flush();
       

        }
}
