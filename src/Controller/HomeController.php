<?php

namespace App\Controller ;

use Symfony\Component\HttpFoundation\Response ;
#use Twig\Environment ;

use App\Repository\PropertyRepository ;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController ;

use Symfony\Component\Routing\Annotation\Route;

#use Symfony\Component\Routing\Annotation\Route;
#use  Twig\Environment ;

class HomeController extends AbstractController
{


  /**
  * @Route ("/" ,  name = "home")
  * @param PropertyRepository $repository
  */

  public function index(PropertyRepository $repository ) : Response
    {
      $properties = $repository -> findLatest() ;
      return $this ->render('pages/home.html.twig' , ['properties' => $properties]) ;
    }


}


?>
