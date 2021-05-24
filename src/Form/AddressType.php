<?php

namespace App\Form;

use App\Entity\City;
use App\Entity\Address;
use App\Entity\Country;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number')
            ->add('street')
            ->add('zipcode')            
            ->add(
            'country',
            EntityType::class,
            [
                'class' => Country::class,
                'choice_label' => 'countryName',
                'placeholder' => 'Country',
                'required' => false
            ]
            )
            ->add(
                'city',
                EntityType::class,
                [
                    'class' => City::class,
                    'choice_label' => 'cityName',
                    'placeholder' => 'City',
                    'required' => false
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
