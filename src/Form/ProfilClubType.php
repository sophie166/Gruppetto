<?php

namespace App\Form;

use App\Entity\ProfilClub;
use App\Entity\Sport;
use phpDocumentor\Reflection\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ProfilClubType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nameClub')
            ->add('cityClub')
            ->add('logoClub', FileType::class, ['label'=>'Logo',
                // unmapped because the fiedl is not associate to any entity//
                'mapped'=> false,
                // require is false, don't have to re-upload if the user edit is profil//
                'required'=> false,
                // security applications, max size, documents type//
                 'constraints'=> [
                     new File([
                         'maxSize'=> '500K',
                         'maxSizeMessage'=> 'The file is too large',
                         'mimeTypes' =>[
                             'image/jpeg',
                             'image/png',
                         ],
                         'mimeTypesMessage'=>'Please upload a png or jpg file.'
                     ])
                 ]
            ])

            ->add('descriptionClub')
        ;
        $options=null;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProfilClub::class,
        ]);
    }
}
