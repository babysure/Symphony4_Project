<?php

namespace App\Controller\Admin ;

use Symfony\Component\HttpFoundation\Response ;

use Doctrine\Common\Persistence\ObjectManager ;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController ;

use Symfony\Component\Routing\Annotation\Route;

use App\Repository\PropertyRepository ;

use App\Entity\Property ;

use App\Form\PropertyType ;

use  Knp\Component\Pager\PaginatorInterface ;

use Symfony\Component\HttpFoundation\Request;

use App\Entity\NewOption ;


/**
 *
 */
class AdminController extends AbstractController
{


  /**
    * @var PropertyRepository
  */

   private $repository ;


   /**
      * @var ObjectManager
   */

   private $em ;

  public function __construct(PropertyRepository $repository , ObjectManager $em  )
  {

      $this -> repository = $repository ;

      $this -> em = $em ;

  }





  /**
      *  @Route("/admin", name="admin.index" )
      *  @param Property $property
      *  @return Response
  */

  public function index(PaginatorInterface $paginator ,  Request $request): Response {


    $query  = $this -> repository -> findAllVisibleQuery() ;



    //$properties =   $this -> repository -> findAll() ; //rechercher tous les biens

    $properties = $paginator->paginate(
     $query, /* query NOT result */
     $request->query->getInt('page', 1), /*page number*/
      12  /*limit per page*/) ;

    return $this -> render('admin/property/index.html.twig' , /*compact('properties') */
        [ 'properties' => $properties]);

  }




  /**
     *  @Route("/admin/create", name="admin.new")
     *  @param Request $request
     *  @return Response
  */
  public function new(Request $request ) {

    $property = new Property() ;

    // création d'un nouveau formulaire à partir de la class Property
    $form = $this -> createForm(PropertyType::class , $property) ;
    $form -> handleRequest($request) ;

    if ($form->isSubmitted() && $form->isValid() ) {

      dump('on est dans la condition') ;

      $this -> em -> persist($property) ; //préparer la requête faite manuellement

      $this -> em -> flush() ; //envoyer la requête à la base de donnée

      $this -> addFlash('success', $property . 'a été créer avec succès') ;

      return $this -> redirectToRoute('admin.index');

    }

    return $this -> render('admin/property/new.html.twig' , [
      'property' => $property ,
      'form' => $form -> createView()
    ]);

  }



  /**
     *  @Route("/admin/{id}", name="admin.edit" , requirements={"id":"\d+"} , methods = "GET|POST" )
     *  @param Property $property
     *  @param Request $request
     *  @return Response
  */

  public function edit(Property $property , Request $request ) : Response
  {

    $form  = $this -> createForm( PropertyType::class , $property ) ;



    $form -> handleRequest($request) ;


    if ($form->isSubmitted() && $form->isValid() ) {

      dump('on est dans la condition') ;


      $this -> em -> flush() ;

      $this -> addFlash('success',  $property -> getTitle().' a été modifié avec succès') ; //$this -> addFlash('id',msg)

      return $this -> redirectToRoute('admin.index'); // on se redirige vers la route admin.index

    }


    return $this -> render('admin/property/edit.html.twig'  ,
    [ 'property' =>  $property , 'form' => $form -> createView()  ]) ;
  }

  /**
  * @Route("/admin/delete/{id}", name="admin.delete" , methods="DELETE" )
  * @param Property $property
  * @return Response
  */

  public function delete(Property $property ,  Request $request ){

    if($this -> isCsrfTokenValid( /* id_token */ 'delete' . $property -> getId() , $request -> get('_token') ) ){

      $name_property = $property -> getTitle() ;

      $this -> em -> remove($property) ; // demande de supression

      $this -> em -> flush() ; //envoit requête en base de donné

      $this -> addFlash('success', $name_property .' a été supprimé avec succès') ;  //$this -> addFlash('id',msg)

      return $this -> redirectToRoute('admin.index', ['nameProperty' => $name_property ]); // on se redirige vers la route admin.index

    }
  }

}


?>
