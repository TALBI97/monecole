<?php

namespace App\Repository;

use App\Entity\MotPasseOublie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MotPasseOublie|null find($id, $lockMode = null, $lockVersion = null)
 * @method MotPasseOublie|null findOneBy(array $criteria, array $orderBy = null)
 * @method MotPasseOublie[]    findAll()
 * @method MotPasseOublie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MotPasseOublieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MotPasseOublie::class);
    }

    // /**
    //  * @return MotPasseOublie[] Returns an array of MotPasseOublie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MotPasseOublie
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
