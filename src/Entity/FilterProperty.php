<?php

namespace App\Entity ;

use Symfony\Component\Validator\Constraints as Assert;


/**
 *
 */
class FilterProperty
{

/**
* @var int|null
* @Assert\Positive
*/
private $maxPrice ;



/**
* @var int|null
* @Assert\Positive
*/
private $minSurface ;



/**
* @param int|null
* @return FilterProperty
*/
public function setMinSurface ( ?int  $minSurface ) : FilterProperty{

  $this -> minSurface = $minSurface ;

  return $this ;
}



/**
* @param int|null
* @return FilterProperty
*/
public function setMaxPrice( ?int  $maxPrice) : FilterProperty {

  $this -> maxPrice = $maxPrice ;

  return $this ;
}



/**
* @return int|null
*/
public function getMaxPrice() : ?int  {

  return $this -> maxPrice ;
}




/**
* @return int|null
*/
public function getMinSurface() : ?int  {

  return $this -> minSurface ;
  }
}
?>
