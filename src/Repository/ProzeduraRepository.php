<?php

namespace App\Repository;

use App\Entity\Prozedura;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Prozedura|null find($id, $lockMode = null, $lockVersion = null)
 * @method Prozedura|null findOneBy(array $criteria, array $orderBy = null)
 * @method Prozedura[]    findAll()
 * @method Prozedura[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProzeduraRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Prozedura::class);
    }

    // /**
    //  * @return Prozedura[] Returns an array of Prozedura objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Prozedura
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
