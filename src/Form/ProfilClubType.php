<?php

namespace App\Form;

use App\Entity\ProfilClub;
use App\Entity\Sport;
use phpDocumentor\Reflection\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfilClubType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nameClub')
            ->add('cityClub')
            ->add('logoClub')
            ->add('descriptionClub')
            ->add('sports', EntityType::class, ['class'=> Sport::class,
                'choice_label'=>'sport_name',])
            ->add('generalChatClub')
            ->add('privateChatClub')
            ->add('users')
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
