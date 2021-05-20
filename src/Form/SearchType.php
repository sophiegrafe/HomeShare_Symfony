<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Data\SearchData;
use App\Entity\City;
use App\Entity\Country;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;


class SearchType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add(
            'capacity',
            NumberType::class,
            ['required' => false]
             )

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
            'data_class' => SearchData::class,
            'method' => 'GET'
        ]);
    }
}
