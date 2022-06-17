<?php

namespace App\Repository;

use App\Entity\KontratuaLote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method KontratuaLote|null find($id, $lockMode = null, $lockVersion = null)
 * @method KontratuaLote|null findOneBy(array $criteria, array $orderBy = null)
 * @method KontratuaLote[]    findAll()
 * @method KontratuaLote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KontratuaLoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, KontratuaLote::class);
    }

    public function getAllSortedBySaila($myFilters)
    {
        $qb = $this->createQueryBuilder('a');
        $qb->select('a', 'k');
        $qb->innerJoin('a.kontratua', 'k');
        $andStatements = $qb->expr()->andX();
        if ( count($myFilters) === 0 ) {
            $qb->orderBy('k.saila', 'ASC');
            return $qb->getQuery()->getResult();
        }

        foreach ($myFilters as $key=>$value) {
            if ( $key === "name" ) {
                $qb->andWhere('LOWER(k.izena_eus) LIKE LOWER(:name)')->setParameter('name', '%' . $value[0] . '%');
                $qb->orWhere('LOWER(k.izena_es) LIKE LOWER(:name)')->setParameter('name', '%' . $value[0] . '%');
            } else if ( ($key === "isFixed") && ($value[0] !== "") ) {
                $qb->andWhere('k.isFixed = :isfixed')->setParameter('isfixed', $value[0]);
            } else if ( $key === "kontratista" ) {
                $qb->innerJoin('a.kontratista', 'kontratista');
                $qb->andWhere('kontratista.id=:kontratistaID')->setParameter('kontratistaID', $value[0]);
            } else if ( $key === "saila" && $value[0] !== "") {
                $qb->innerJoin('k.saila', 'saila');
                $qb->andWhere('saila.id=:sailaID')->setParameter('sailaID', $value[0]);
            } else if ( $key === "egoera"  && $value[0] !== "") {
                $qb->innerJoin('k.egoera', 'egoera');
                $qb->andWhere('egoera.id=:egoeraID')->setParameter('egoeraID', $value[0]);
            }
        }
        $qb->andWhere($andStatements);
        $qb->orderBy('a.id', 'DESC');

        return $qb->getQuery()->getResult();
    }

    public function getAll()
    {
        $qb = $this->createQueryBuilder('a')
            ->select('a','k', 'ko', 'm')
            ->innerJoin('a.kontratua', 'k')
            ->innerJoin('a.kontratista', 'ko')
            ->leftJoin('k.mota', 'm')
        ;

        return $qb->getQuery()->getResult();
    }

}
