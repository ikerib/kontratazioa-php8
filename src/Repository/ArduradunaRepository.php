<?php

namespace App\Repository;

use App\Entity\Arduraduna;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Arduraduna|null find($id, $lockMode = null, $lockVersion = null)
 * @method Arduraduna|null findOneBy(array $criteria, array $orderBy = null)
 * @method Arduraduna[]    findAll()
 * @method Arduraduna[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArduradunaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Arduraduna::class);
    }

    // /**
    //  * @return Arduraduna[] Returns an array of Arduraduna objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Arduraduna
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
