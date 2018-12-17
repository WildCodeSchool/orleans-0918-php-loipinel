<?php

namespace App\Repository;

use App\Entity\Finances;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Finances|null find($id, $lockMode = null, $lockVersion = null)
 * @method Finances|null findOneBy(array $criteria, array $orderBy = null)
 * @method Finances[]    findAll()
 * @method Finances[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FinancesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Finances::class);
    }
}
