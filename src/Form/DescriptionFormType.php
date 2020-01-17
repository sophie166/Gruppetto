<?php

namespace App\Form;

use App\Entity\ProfilClub;
use App\Entity\Sport;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;

class DescriptionFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('LogoClub', FileType::class, [
            "label" => false,
            "required" => false,
            ])
            ->add('DescriptionClub', TextareaType::class, [
                "label" => false,
                "required" => false,
                'attr'=> [
                    'placeholder'=>'Description',
                    'class' => 'green-input']
            ])
            ->add('nameClub', TextType::class, [
                    "label" => false,
                    "required" => true,
                    "attr" => [
                        "placeholder" => "Nom du Club",
                        "class" => "green-input"
                    ],
                    "constraints" => new IsTrue([
                        "message" => "Veuillez remplir le nom du Club"
                    ])
            ])
            ->add('sport', EntityType::class, [
                "class" => Sport::class])
            ->add('cityClub', TextType::class, [
                    "label" => false,
                    "required"=> true,
                    "attr" => [
                        "placeholder" => "Nom de la Ville",
                        "class" => "green-input"
                    ],
                    "constraints" => [
                        new IsTrue([
                            "message" => "Veuillez renseigner votre Ville"
                        ])
                    ]
                ]);

        $options = null;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProfilClub::class, Sport::class
        ]);
    }
}
