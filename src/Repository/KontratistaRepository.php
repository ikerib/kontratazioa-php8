<?php

namespace App\Repository;

use App\Entity\Kontratista;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Kontratista|null find($id, $lockMode = null, $lockVersion = null)
 * @method Kontratista|null findOneBy(array $criteria, array $orderBy = null)
 * @method Kontratista[]    findAll()
 * @method Kontratista[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KontratistaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Kontratista::class);
    }

    // /**
    //  * @return Kontratista[] Returns an array of Kontratista objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Kontratista
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
