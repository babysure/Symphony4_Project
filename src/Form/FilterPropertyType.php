<?php

namespace App\Form;

use App\Entity\FilterProperty;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;


class FilterPropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('maxPrice' , IntegerType::class , [

              'required' => false ,
              'label' => false ,
              'attr' => [
                  'placeholder' => 'Budget max'


              ]

            ])
            ->add('minSurface' , IntegerType::class , [

              'required' => false ,
              'label' => false ,
              'attr' => [
                'placeholder' => 'Surface min'
              ]

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FilterProperty::class,
            'method' => 'get' ,
            'crsf_protection' => false
        ]);
    }

    public function getBlockPrefix(){

      return '' ;

    }

}
