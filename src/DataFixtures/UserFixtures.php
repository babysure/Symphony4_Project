<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User ;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

    public function  __construct(UserPasswordEncoderInterface $encoder ){

      $this -> encoder = $encoder ;

    }

    public function load(ObjectManager $manager)
    {
      $user = new User() ;


      $username = 'demo' ;

      $password =  'demo' ;

      $user -> setUsername($username) ;



      $encoded = $this -> encoder -> encodePassword($user, $password) ;

      $user -> setPassword($encoded ) ;

      $manager -> persist($user) ;

      $manager->flush();
    }
}
