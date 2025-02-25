<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function getNewId(): int
    {
        $query = $this->createQueryBuilder('u')
            ->select('MAX(u.id)')
            ->getQuery()
            ->getSingleScalarResult();

        return $query + 1;
    }
    public function findAllSortedByPriceDesc(): array
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.price', 'DESC')
            ->getQuery()
            ->getResult();
    }

//    public function findOneBySomeField($value): ?Product
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
