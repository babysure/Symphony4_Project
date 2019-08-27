<?php

namespace App\DataFixtures;


use App\Entity\Property ;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use Faker\Factory ;

class PropertyFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create('fr_FR');

        for( $i = 0 ; $i <= 100 ; $i ++ ){

          $property = new Property() ;

          $property

            -> setTitle($faker-> name)

            -> setDescription('Bonjour voici la très petite
            description du bien n°'. $i)

            -> setSurface( rand ( 20 ,  500 ) )

            -> setRooms(  rand ( 2 ,  10 ) )

            -> setBedrooms(rand ( 2 ,  10 ))

            -> setFloor( rand( 0  , 20) )

            -> setPrice( rand( 0 ,1000000 ) )

            -> setHeat( rand( 0 , count( Property::HEAT) -1 )  )

            -> setCity( $faker-> city )

            -> setAddress( $faker -> address )

            -> setPostalCode( $faker -> postcode )

            -> setSold( false  );



            $manager -> persist($property) ;
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
