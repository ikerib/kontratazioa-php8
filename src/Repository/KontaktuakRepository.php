<?php

namespace App\Repository;

use App\Entity\Kontaktuak;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Kontaktuak|null find($id, $lockMode = null, $lockVersion = null)
 * @method Kontaktuak|null findOneBy(array $criteria, array $orderBy = null)
 * @method Kontaktuak[]    findAll()
 * @method Kontaktuak[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KontaktuakRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Kontaktuak::class);
    }

    // /**
    //  * @return Kontaktuak[] Returns an array of Kontaktuak objects
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
    public function findOneBySomeField($value): ?Kontaktuak
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
