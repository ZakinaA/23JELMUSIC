<?php

namespace App\Form;

use App\Entity\Cours;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle', TextType::class)
            ->add('AgeMini', TextType::class)
            ->add('HeureDebut')
            ->add('HeureFin')
            ->add('NbPlaces', TextType::class)
            ->add('AgeMaxi', TextType::class)
            ->add('typeCours', EntityType::class, array('class' => 'App\Entity\TypeCours','choice_label' => 'libelle' ))
            ->add('jours', EntityType::class, array('class' => 'App\Entity\Jours','choice_label' => 'libelle' ))
            ->add('professeur', EntityType::class, array('class' => 'App\Entity\Professeur','choice_label' => 'nom' ))
            ->add('instrument', EntityType::class, array('class' => 'App\Entity\Instrument','choice_label' => 'nom' ))
            ->add('save', SubmitType::class, array('label' => 'Créer un cours'));
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cours::class,
        ]);
    }
}
