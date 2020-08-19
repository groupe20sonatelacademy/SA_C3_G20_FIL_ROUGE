<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FormateurController extends AbstractController
{
   
   /**
     * @var UserPasswordEncoderInterface
     * L'encodeur de mot de pass
     */
    private $manager;

    public function __construct(UserPasswordEncoderInterface $manager)
    {
        $this->manager = $encoder;
    }
        public function addFormateurByUsername(string $username, formateurRepository $formateurRepository)
        {
            $formateur = $formateurRepository->findOneBy(["username" => $username]);
             $manager->persist($formateur);
             $manager->flush();
       

        }
}
