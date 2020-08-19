<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FormateurController extends AbstractController
{
   
    /**
* @Route("/formateur/{username}", name="addformateur")
*/
        public function showFormateurByUsername(string $username, formateurRepository $formateurRepository)
        {
            $formateur = $formateurRepository->findOneBy(["username" => $username]);
            if (!$formateur) {
            throw $this->createNotFoundException('Formateur non trouvé');
        }
        return $this->render('formateur/index.html.twig', [
        'controller_name' => 'formateurController',
        'formateur' => $formateur ]);

        }
}
