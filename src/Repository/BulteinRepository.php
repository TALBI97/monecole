<?php

namespace App\Repository;

use App\Entity\Bultein;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bultein|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bultein|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bultein[]    findAll()
 * @method Bultein[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BulteinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bultein::class);
    }

    // /**
    //  * @return Bultein[] Returns an array of Bultein objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bultein
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
