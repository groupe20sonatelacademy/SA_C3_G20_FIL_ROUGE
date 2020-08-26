<?php

namespace App\Controller;

use App\Repository\ProfilsortieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProfilsortieController extends AbstractController
{
    /**
     * @Route(
     *    name="getProfilsortieAndApprenant",
     *     path="api/admin/profilsorties/{id}",
     *      methods={"GET"}
     *     )
     */
    public function getProfilsortieAndApprenant(int $id,ProfilsortieRepository $profilsortieRepository)
    {

        $profilsortie = $profilsortieRepository->findOneBy(["id" => $id]);
        $profilsorties= $profilsortie->getApprenant();
        if ($profilsorties) {

       // dd($profilsortie);
            return $this->json($profilsortie, 200, [], ["groups" => ["profilsortieApp:read"]]);
        }
        return $this->json(["message" => "ressource inexistante", 404]);
       
    }












}
