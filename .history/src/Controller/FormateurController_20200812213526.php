<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class FormateurController extends AbstractController
{
   
   /**
     * @var UserPasswordEncoderInterface
     * L'encodeur de mot de pass
     */
    private $manager;

    public function __construct(Mana $manager)
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
