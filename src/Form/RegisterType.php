<?php

namespace App\Form;

use App\Entity\City;
use App\Entity\User;
use App\Entity\Country;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')           
            ->add('firstname')
            ->add('lastname')
            ->add('pseudo')
            ->add('phone_number')
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
            )          
            ->add(
            'password',
            PasswordType::class, 
            [   
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add(
            'agreeTerms',
             CheckboxType::class,
            [
                'mapped' => false,
                'constraints' =>
                [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ]);
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
