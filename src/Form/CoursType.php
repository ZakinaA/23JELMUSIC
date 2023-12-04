<?php

namespace App\Form;

use App\Entity\Cours;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Constraints as Assert;

class CoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('typeInstruments', EntityType::class, array('class' => 'App\Entity\TypeInstrument','choice_label' => 'libelle' ))
            ->add('jours', EntityType::class, array('class' => 'App\Entity\Jours','choice_label' => 'libelle' ))
            ->add('HeureDebut', TimeType::class, [
                'widget' => 'single_text',
            ])
            ->add('HeureFin', TimeType::class, [
                'widget' => 'single_text',
            ])
            ->add('libelle', TextType::class, [
                'constraints' => [
                    new Length([
                        'max' => 50,
                        'maxMessage' => 'Le libellé ne peut pas dépasser {{ limit }} caractères.',
                    ]),
                    new Regex([
                        'pattern' => '/^[A-Za-z0-9\s]+$/',
                        'message' => 'Le libellé ne peut contenir que des lettres, des chiffres et des espaces.',
                    ]),
                ],
            ])
            ->add('AgeMini', TextType::class)
            ->add('AgeMaxi', TextType::class)
            ->add('NbPlaces', IntegerType::class)
            ->add('typeCours', EntityType::class, [
                'class' => 'App\Entity\TypeCours',
                'choice_label' => 'libelle',
                'constraints' => [
                    new Assert\Callback(['callback' => [$this, 'validateNbPlacesAndTypeCours']]),
                ],
            ])
            ->add('professeur', EntityType::class, array('class' => 'App\Entity\Professeur','choice_label' => 'nom' ))
            ->add('save', SubmitType::class, array('label' => 'Créer un cours'));
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cours::class,
        ]);
    }

    public function validateNbPlacesAndTypeCours($value, ExecutionContextInterface $context)
    {
        $NbPlaces = $context->getRoot()->get('NbPlaces')->getData();
        $typeCours = $value;

        // Check if typeCours is not null
        if ($typeCours !== null) {
            // If the number of places is 1, typeCours must be "Individuel"
            if ($NbPlaces === 1 && $typeCours->getLibelle() !== 'Cours Individuel') {
                $context->buildViolation('Si le nombre de place est de 1 le type de cours doit être Individuel.')
                    ->atPath('typeCours')
                    ->addViolation();
            }

            // If the number of places is greater than 1, typeCours must be "Collectif"
            if ($NbPlaces > 1 && $typeCours->getLibelle() !== 'Cours Collectif') {
                $context->buildViolation('Si le nombre de place est superieure à 1 le type de cours doit être Collectif.')
                    ->atPath('typeCours')
                    ->addViolation();
            }
        }
    }
}
