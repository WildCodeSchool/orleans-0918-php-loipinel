<?php

namespace App\Repository;

use App\Entity\UploadJson;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UploadJson|null find($id, $lockMode = null, $lockVersion = null)
 * @method UploadJson|null findOneBy(array $criteria, array $orderBy = null)
 * @method UploadJson[]    findAll()
 * @method UploadJson[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UploadJsonRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UploadJson::class);
    }

    // /**
    //  * @return UploadJson[] Returns an array of UploadJson objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UploadJson
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
