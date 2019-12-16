<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => false,
                'required'=>true,
                'attr'=> [
                    'placeholder'=>'E-mail',
                    'class' => 'green-input'
                ]
                ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter nos CGU pour continuer.',
                    ]),
                ],
                'label_attr'=>['class' => 'cgu'],
                'label'=>'En m’inscrivant, je certifie avoir lu et accepté les Conditions Générales d’Utilisation'
            ])
            ->add('plainPassword', RepeatedType::class, [
                'constraints' => [new Length(['min' => 3]), new NotBlank()],
                'type'=>PasswordType::class,
                'mapped' => false,
                'invalid_message'=>'Passwords must match',
                'first_options' => ['label' => false, 'attr'=>['placeholder'=>'Mot de passe']],
                'second_options' => ['label' => false, 'attr'=>['placeholder'=>'Confirmer le mot de passe']]
            ])
        ;
        $options = null;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
