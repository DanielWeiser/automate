<?php

namespace App\Repository;

use App\Entity\ContractProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ContractProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContractProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContractProduct[]    findAll()
 * @method ContractProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContractProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContractProduct::class);
    }

    // /**
    //  * @return ContractProduct[] Returns an array of ContractProduct objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ContractProduct
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
