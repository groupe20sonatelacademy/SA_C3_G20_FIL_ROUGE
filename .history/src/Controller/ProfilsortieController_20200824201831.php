<?php

namespace App\Controller;

use App\Repository\ApprenantRepository;
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
    public function getProfilsortieAndApprenant(int $id,ProfilsortieRepository $profilsortieRepository,ApprenantRepository $apprenantRepository)
    {
$profils=[];
        $apprenant = $apprenantRepository->findOneBy(["id" => $id]);
       
        //dd($profilsortie);
        if ($apprenant) {
            foreach ($apprenant->getApprenant() as $value) {
                $profils[]=$apprenantRepository->find($value->getProfilsortie()->getId());
            }

       dd($profils);
            return $this->json($profilsortieRepository->findAll(), 200, [], ["groups" => ["profilsortieApp:read"]]);
        }
        return $this->json(["message" => "ressource inexistante", 404]);
       
    }












}
