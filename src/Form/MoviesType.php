<?php

namespace App\Form;

use App\Entity\Actors;
use App\Entity\Genres;
use App\Entity\Movies;
use App\Entity\Realisateurs;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MoviesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class)
            ->add('synopsis', TextType::class)
            ->add('img', TextType::class)
            ->add('release_date', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('actors', EntityType::class, [
                'class' => Actors::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('genres', EntityType::class, [
                'class' => Genres::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('realisateurs', EntityType::class, [
                'class' => Realisateurs::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movies::class,
        ]);
    }
}
