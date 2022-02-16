<?php

namespace App\Repository;

use App\Entity\Notification;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Notification|null find($id, $lockMode = null, $lockVersion = null)
 * @method Notification|null findOneBy(array $criteria, array $orderBy = null)
 * @method Notification[]    findAll()
 * @method Notification[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NotificationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Notification::class);
    }

    public function getByLote($loteid)
    {
        $qm = $this->createQueryBuilder('n')
            ->innerJoin('n.lote', 'l')
            ->andWhere('l.id = :loteid')->setParameter('loteid', $loteid)
            ->orderBy('n.noiz', 'DESC')
        ;

        return $qm->getQuery()->getResult();
    }

    public function getAllNotifications()
    {
        $qb = $this->createQueryBuilder('n')
            ->andWhere('n.notify=:value')->setParameter('value',1)
        ;

        return $qb->getQuery()->getResult();
    }

    public function getAllUnEmailedNotifications()
    {
        $qb = $this->createQueryBuilder('n')
            ->andWhere('n.notify=:notify')->setParameter('notify',1)
            ->andWhere('n.emailed=:emailed')->setParameter('emailed',0)
        ;

        return $qb->getQuery()->getResult();
    }
}
