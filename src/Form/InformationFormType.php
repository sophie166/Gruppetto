<?php

namespace App\Form;

use App\Entity\ProfilClub;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;

class InformationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('profilClub', TextType::class, [
                'label' => false,
                'required'=>true,
                'attr'=> [
                    'placeholder'=>'Nom du club',
                    'class' => 'green-input'
                ],
                'constraints' => [
                    new IsTrue([
                        'message' => 'le Nom du club est manquant .'
                    ])
                ]])
            ->add('sport', TextType::class, [
                'label' => false,
                'required'=>true,
                'attr'=> [
                    'placeholder'=>'Nom du sport',
                    'class' => 'green-input'
                ],
                'constraints' => [
                    new IsTrue([
                        'message' => 'le Nom du sport est manquant .'
                    ])
                ]])
            ->add('ville', TextType::class, [
                'label' => false,
                'required'=>true,
                'attr'=> [
                    'placeholder'=>'Ville',
                    'class' => 'green-input'
                ],
                'constraints' => [
                    new IsTrue([
                        'message' => 'le Nom de la Ville est manquant .'
                    ])
                ]]);
        $options = null;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null
        ]);
    }
}
