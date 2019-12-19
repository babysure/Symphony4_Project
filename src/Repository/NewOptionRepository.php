<?php

namespace App\Repository;

use App\Entity\NewOption;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method NewOption|null find($id, $lockMode = null, $lockVersion = null)
 * @method NewOption|null findOneBy(array $criteria, array $orderBy = null)
 * @method NewOption[]    findAll()
 * @method NewOption[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewOptionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, NewOption::class);
    }

    // /**
    //  * @return NewOption[] Returns an array of NewOption objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NewOption
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
