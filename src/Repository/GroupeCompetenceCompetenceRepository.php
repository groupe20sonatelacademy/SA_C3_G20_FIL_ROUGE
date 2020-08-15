<?php

namespace App\Repository;

use App\Entity\GroupeCompetenceCompetence;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GroupeCompetenceCompetence|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupeCompetenceCompetence|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupeCompetenceCompetence[]    findAll()
 * @method GroupeCompetenceCompetence[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupeCompetenceCompetenceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GroupeCompetenceCompetence::class);
    }

    // /**
    //  * @return GroupeCompetenceCompetence[] Returns an array of GroupeCompetenceCompetence objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GroupeCompetenceCompetence
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
