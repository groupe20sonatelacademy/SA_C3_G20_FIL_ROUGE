<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FormateurController extends AbstractController
{
   
    /**
* @Route("/formateur/{username}", name="addformateurs")
*/
        public function showPersonneByNomAndPrenom(string $username, formateurRepository $formateurRepository)
        {
        $formateur = $formateurRepository->findOneBy([ "username" => $username]);
        if (!$formateur) {
        throw $this->createNotFoundException('Personne non trouv´ee');
        }
        return $this->render(personne/index.html.'twig’, [
        'controller_name' => 'formateurController',
        'formateur' => $formateur,
        'adjectif' => 'recherchee' ]);

        }
}
