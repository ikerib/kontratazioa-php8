<?php

namespace App\Repository;

use App\Entity\Kontratua;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Kontratua|null find($id, $lockMode = null, $lockVersion = null)
 * @method Kontratua|null findOneBy(array $criteria, array $orderBy = null)
 * @method Kontratua[]    findAll()
 * @method Kontratua[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KontratuaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Kontratua::class);
    }

    // /**
    //  * @return Kontratua[] Returns an array of Kontratua objects
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
    public function findOneBySomeField($value): ?Kontratua
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
