<?php

namespace App\Controller\Api;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class ArchivageUser
{
    //On injecte l'entity manager

    /**
     *
     * @var EntityManagerInterface
     */
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    //On lui passe notre data de type user via l'id
    public function __invoke(User $data)
    {   
        //On récupère notre user
        $user = $data;
        //On change le statut de l'archivage
        $user->setArchivage(1);
        //On renvoi l'élément dans la BD
        $this->em->flush($user);

        return $user;
    }

}