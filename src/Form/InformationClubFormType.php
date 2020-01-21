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
use Symfony\Component\Validator\Constraints\File;

class InformationClubFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nameClub', TextType::class, [
                "label" => false,
                "required" => true,
                "attr" => [
                    "placeholder" => "Nom du Club",
                    "class" => "green-input"
                ]
            ])

            ->add('sport', EntityType::class, [
                "class" => Sport::class,
                'attr'=> [
                    'class' => 'green-input'
                ]])

            ->add('cityClub', TextType::class, [
                "label" => false,
                "required"=> true,
                "attr" => [
                    "placeholder" => "Nom de la Ville",
                    "class" => "green-input"
                ]
            ])

            ->add('LogoClub', FileType::class, [
                "label" => false,
                "required" => false,
                "attr" => [
                    'placeholder'=>"Logo du Club"],
            ])

            ->add('DescriptionClub', TextareaType::class, [
                "label" => false,
                "required" => false,
                'attr'=> [
                    'placeholder'=>'Description',
                    'class' => 'green-input']
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
