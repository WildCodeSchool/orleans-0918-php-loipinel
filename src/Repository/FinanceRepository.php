<?php

namespace App\Repository;

use App\Entity\Finance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Finance|null find($id, $lockMode = null, $lockVersion = null)
 * @method Finance|null findOneBy(array $criteria, array $orderBy = null)
 * @method Finance[]    findAll()
 * @method Finance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FinanceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Finance::class);
    }
}
