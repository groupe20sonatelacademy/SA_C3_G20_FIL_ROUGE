<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class FormateurController extends AbstractController
{
   
   /**
     * @var ManagerInterface
     * L'encodeur de mot de pass
     */
    private $manager;

    public function __construct(EManagerInterface $manager)
    {
        $this->manager = $manager;
        
    }
        public function addFormateurByUsername(string $username, formateurRepository $formateurRepository)
        {
            $formateur = $formateurRepository->findOneBy(["username" => $username]);
             $manager->persist($formateur);
             $manager->flush();
       

        }
}
