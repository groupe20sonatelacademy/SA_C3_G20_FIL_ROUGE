<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FormateurController extends AbstractController
{
   
    /**
* @Route("/personne/{nom}/{prenom}", name="personne_show_one")
*/
        public function showPersonneByNomAndPrenom(string $nom, string $prenom,
        PersonneRepository $personneRepository)
        {
        $personne = $personneRepository->findOneBy([
        "nom" => $nom,
        "prenom" => $prenom
        ]);
        if (!$personne) {
        throw $this->createNotFoundException(’Personne non trouv´ee’);
        }
        return $this->render(’personne/index.html.twig’, [
        ’controller_name’ => ’PersonneController’,
        ’personne’ => $personne,
        ’adjectif’ => ’recherch´ee’
}
