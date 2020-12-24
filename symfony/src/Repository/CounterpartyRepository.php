<?php

namespace App\Repository;

use App\Entity\Counterparty;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Counterparty|null find($id, $lockMode = null, $lockVersion = null)
 * @method Counterparty|null findOneBy(array $criteria, array $orderBy = null)
 * @method Counterparty[]    findAll()
 * @method Counterparty[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CounterpartyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Counterparty::class);
    }
}
