<?php

namespace App\Form;

use App\Entity\City;
use App\Entity\Country;
use App\Entity\Property;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   

        $builder
            ->add('title')
            ->add('shortDescription')
            ->add('longDescription')
            ->add('capacity')
            ->add('nbBathroom')
            ->add('nbWc')
            ->add('isEnable')            
            ->add('photoFile',
                FileType::class,
                [
                 'required' => false
                ]
            )
            ->add(
                'country',
                EntityType::class,
                [
                    'class' => Country::class,
                    'choice_label' => 'countryName',
                    'placeholder' => 'Country',
                    'required' => false,
                ]
            )
            ->add(
                'city',
                EntityType::class,
                [
                    'class' => City::class,
                    'choice_label' => 'cityName',
                    'placeholder' => 'City',
                    'required' => false,
                ]
            );        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
        ]);
    }
}
