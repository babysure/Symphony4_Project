<?php

namespace App\Controller ;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController ;
use Symfony\Component\HttpFoundation\Response ;
use Symfony\Component\Routing\Annotation\Route;

//Class pour authentification
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils ;




/**
 *
 */
class SecurityController  extends AbstractController
{




  /**
  *  @return Response
  *  @Route("/login", name="login" )
  */
  public function login(AuthenticationUtils $authentication ){

    $error = $authentication -> getLastAuthenticationError();

    $lastUsername = $authentication -> getLastUsername();

    return $this -> render('security/login.html.twig', [


        'last_username' => $lastUsername,
        'error'         => $error,
    ]);
  }
}
