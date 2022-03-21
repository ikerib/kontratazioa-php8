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

    public function countAll()
    {
        return $this->createQueryBuilder('k')
            ->select('COUNT(k.id)')
            ->getQuery()->getSingleScalarResult();
    }

    public function countOpen()
    {
        $qb = $this->createQueryBuilder('k');
        $qb->select('COUNT(k.id)');
        $qb->leftJoin('k.egoera', 'e');
        $qb->orWhere('k.egoera IS NULL');
        $qb->orWhere('e.name <> :amaiatuta')->setParameter('amaiatuta', 'Amaituta');

        return $qb->getQuery()->getSingleScalarResult();

    }

    public function countBySaila()
    {
        $qb = $this->createQueryBuilder('k');
        $qb->select('COUNT(k.id) as zenbat, s.izena');
        $qb->leftJoin('k.saila', 's');
        $qb->groupBy('s.izena');
        $qb->orderBy('zenbat', 'DESC');
        return $qb->getQuery()->getResult();
    }

    public function countByEgoera()
    {
        $qb = $this->createQueryBuilder('k');
        $qb->select('COUNT(k.id) as zenbat, e.name');
        $qb->leftJoin('k.egoera', 'e');
        $qb->groupBy('e.name');
        $qb->orderBy('zenbat', 'DESC');
        return $qb->getQuery()->getResult();
    }

    public function countByMota()
    {
        $qb = $this->createQueryBuilder('k');
        $qb->select('COUNT(k.id) as zenbat, m.mota_eus');
        $qb->leftJoin('k.mota', 'm');
        $qb->groupBy('m.mota_eus');
        $qb->orderBy('zenbat', 'DESC');
        return $qb->getQuery()->getResult();
    }

    public function countByProzedura()
    {
        $qb = $this->createQueryBuilder('k');
        $qb->select('COUNT(k.id) as zenbat, p.prozedura_eus');
        $qb->leftJoin('k.prozedura', 'p');
        $qb->groupBy('p.prozedura_eus');
        $qb->orderBy('zenbat', 'DESC');
        return $qb->getQuery()->getResult();
    }

    public function countByArduraduna()
    {
        $qb = $this->createQueryBuilder('k');
        $qb->select('COUNT(k.id) as zenbat, a.name');
        $qb->leftJoin('k.arduraduna', 'a');
        $qb->groupBy('a.name');
        $qb->orderBy('zenbat', 'DESC');
        return $qb->getQuery()->getResult();
    }

    public function countByYear()
    {
        $qb = $this->createQueryBuilder('k');
        $qb->select('COUNT(l.id) as zenbat, k.izena_eus', 'to_char(sinadura, "YYYYY") as Urtea');
        $qb->innerJoin('k.lotes', 'l');
        $qb->groupBy('l.sinadura');
        $qb->orderBy('Urtea', 'ASC');
        return $qb->getQuery()->getResult();
    }
}
