<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FormateurController extends AbstractController
{
   
    /**
* @Route("/personne/{nom}/{prenom}", name="formateurshow")
*/
        public function showPersonneByNomAndPrenom(string $username, FormateurRepository $formateurRepository)
        {
        $personne = $formateurRepository->findOneBy([ "username" => $username]);
        if (!$formateur) {
        throw $this->createNotFoundException(’Personne non trouv´ee’);
        }
        return $this->render(’personne/index.html.twig’, [
        ’controller_name’ => ’formateurController’,
        ’formateur’ => $formateur,
        ’adjectif’ => ’recherch´ee’ ]);
        
        }
}
