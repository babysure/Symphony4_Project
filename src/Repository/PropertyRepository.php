<?php

namespace App\Repository;

use App\Entity\Property;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\QueryBuilder ;
use Doctrine\ORM\Query ;
use App\Entity\FilterProperty ;


/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Property::class);
    }


    /**
    * Si on renseigne aucun paramètre cela veut dire que l'on veut juste voir les bien sinon
    * la méthode filtre les bien en fonction des contrainte de l'objet FilterProperty passé en paramètre
    *
    * @param FilterProperty
    * @return Query
    */
    public function findAllVisibleQuery( FilterProperty $search = NULL ) : Query
    {

      $query = $this-> findVisibleQuery() ;



      if( False == is_null($search) ){


        if(   $search -> getMaxPrice()  ) {

          $query = $query -> andWhere('p.price <='.  $search -> getMaxPrice() ) ;

        }



        if ( $search -> getMinSurface()  ){

          $query = $query -> andWhere('p.surface >='. $search  -> getMinSurface() );


        }


      }


       return  $query -> getQuery() ;


    }


    /**
    * @return Property
    */
    public function findLatest() : array
    {

      return $this-> findVisibleQuery()
          ->setMaxResults(4)
          -> getQuery()
          ->getResult()
      ;
    }


    private function findVisibleQuery() : QueryBuilder
    {
    return $this -> createQueryBuilder('p')

                 -> where('p.sold = false')


    ;}

    // /**
    //  * @return Property[] Returns an array of Property objects
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
    public function findOneBySomeField($value): ?Property
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
