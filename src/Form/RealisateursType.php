<?php

namespace App\Form;

use App\Entity\Movies;
use App\Entity\Realisateurs;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RealisateursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('birthdate', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('deathdate', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('movies', EntityType::class, [
                'class' => Movies::class,
                'choice_label' => 'title',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Realisateurs::class,
        ]);
    }
}
