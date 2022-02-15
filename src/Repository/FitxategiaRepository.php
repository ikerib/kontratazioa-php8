<?php

namespace App\Repository;

use App\Entity\Fitxategia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Fitxategia|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fitxategia|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fitxategia[]    findAll()
 * @method Fitxategia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FitxategiaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fitxategia::class);
    }

    // /**
    //  * @return Fitxategia[] Returns an array of Fitxategia objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Fitxategia
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
