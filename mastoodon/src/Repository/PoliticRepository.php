<?php

namespace App\Repository;

use App\Entity\Politic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Politic|null find($id, $lockMode = null, $lockVersion = null)
 * @method Politic|null findOneBy(array $criteria, array $orderBy = null)
 * @method Politic[]    findAll()
 * @method Politic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PoliticRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Politic::class);
    }

    // /**
    //  * @return Politic[] Returns an array of Politic objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Politic
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
