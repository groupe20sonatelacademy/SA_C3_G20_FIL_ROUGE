<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FormateurController extends AbstractController
{
   
    /**
* @Route("/personne/{nom}/{prenom}", name="personne_show_one")
*/
        public function showPersonneByNomAndPrenom(string $username, FormateurRepository $formateurRepository)
        {
        $personne = $formateurRepository->findOneBy([ "username" => $username]);
        if (!$personne) {
        throw $this->createNotFoundException(’Personne non trouv´ee’);
        }
        return $this->render(’personne/index.html.twig’, [
        ’controller_name’ => ’PersonneController’,
        ’personne’ => $personne,
        ’adjectif’ => ’recherch´ee’
}
