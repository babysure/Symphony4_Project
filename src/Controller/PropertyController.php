<?php

namespace App\Controller ;

# use  Twig\Environment ;

use Symfony\Component\HttpFoundation\Response ;


use App\Entity\Property ;

use App\Repository\PropertyRepository ;

use Doctrine\Common\Persistence\ObjectManager ;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController ;
use Symfony\Component\Routing\Annotation\Route;

use  Knp\Component\Pager\PaginatorInterface ;

use Symfony\Component\HttpFoundation\Request;


use App\Entity\FilterProperty ;

use App\Form\FilterPropertyType ;

class PropertyController extends AbstractController {




 /**
 * @var PropertyRepository
 */

  private $repository ;


  public function  __construct(PropertyRepository $repository , ObjectManager $em   ){

    $this-> repository = $repository ;
    $this -> em  = $em ;
  }


    /**
       *  @Route("/biens", name="property.index")
       *  @return Response
    */

  public function index( PaginatorInterface $paginator ,  Request $request  ): Response
  {

      $search = new FilterProperty() ;

      $form = $this -> createForm(FilterPropertyType::class , $search);
      $form -> handleRequest($request) ;

      $query  = $this -> repository -> findAllVisibleQuery( $search ) ;

      $properties = $paginator->paginate(
       $query, /* query NOT result */
       $request->query->getInt('page', 1), /*page number*/
        12  /*limit per page*/) ;

      #$property  = $this -> repository -> findOneBy( ['floor' => 4 ]) ;

      #$this -> em -> flush() ;
      #dump($property) ;


    return $this -> render('property/index.html.twig' ,
    [ 'current_menu' => 'properties' ,
    'properties' => $properties ,
    'form' => $form-> createView()

    ]);



  }



  /**
     *  @Route("/biens/{slug}-{id}", name="property.show" , requirements = {"slug" : "[a-z0-9\-]*" })
     *  @param Property $property
     *  @return Response
  */
  public function show( Property  $property , string $slug ) : Response
  {
    # redirection en cas de mauvais Url


    if ( $property-> getSlug() !== $slug ){

      return  $this-> redirectToRoute( 'property.show' ,[
      'id' => $property -> getId() ,
      'slug' => $property -> getSlug() ] , 301) ;
    }



    #$property = $this -> repository -> find($id) ;


    return $this-> render('property/show.html.twig' , [
      'property' => $property ,
      'current_menu' => 'properties'
    ] );

  }



}

# requirement = { "slug" : "[a-z0-9\-]*"}

 ?>
