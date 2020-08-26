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
$profils=[];
        $profilsortie = $profilsortieRepository->findOneBy(["id" => $id]);
        $profilsorties= $profilsortie->getApprenant();
        if ($profilsorties) {
            foreach ($profilsor as $key => $value) {
                # code...
            }

       // dd($profilsortie);
            return $this->json($profilsorties, 200, [], ["groups" => ["profilsortieApp:read"]]);
        }
        return $this->json(["message" => "ressource inexistante", 404]);
       
    }












}
