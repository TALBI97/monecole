<?php

namespace App\Repository;

use App\Entity\LineClassEleve;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LineClassEleve|null find($id, $lockMode = null, $lockVersion = null)
 * @method LineClassEleve|null findOneBy(array $criteria, array $orderBy = null)
 * @method LineClassEleve[]    findAll()
 * @method LineClassEleve[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LineClassEleveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LineClassEleve::class);
    }

    // /**
    //  * @return LineClassEleve[] Returns an array of LineClassEleve objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LineClassEleve
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
