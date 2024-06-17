<?php

namespace App\Form;

use App\Entity\Actors;
use App\Entity\Movies;
use App\Entity\Roles;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActorsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('birthdate', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('deathdate', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('movie', EntityType::class, [
                'class' => Movies::class,
                'choice_label' => 'title',
                'multiple' => true,
            ])
            ->add('roles', EntityType::class, [
                'class' => Roles::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Actors::class,
        ]);
    }
}