<?php

namespace App\Form;

use App\Entity\Property;
use App\Entity\NewOption ;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('surface')
            ->add('rooms')
            ->add('bedrooms')
            ->add('floor')
            ->add('price')
            ->add('heat', ChoiceType ::class  , [

              'choices' => $this -> getChoices()


            ])
            ->add('city')
            ->add('address')
            ->add('postalCode')
            ->add('sold'  , CheckboxType::class ,  [ 'required' => false ])

            ->add('newOptions' , EntityType::class  , [
              'class' => NewOption::class ,
              'choice_label' => 'name' ,
              'multiple' => true

            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
            'translation_domain' => 'forms'
        ]);
    }

    private function getChoices ()
    {

     $choices = Property :: HEAT ;

     $output = [] ;

     foreach ($choices as $k => $v) {
        $output[$v] = $k ;
     }

     return $output ;

    }
}
