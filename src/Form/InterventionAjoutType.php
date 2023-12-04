<?php

namespace App\Form;

use App\Entity\Intervention;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;

class InterventionAjoutType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Instrument', EntityType::class, array ('class' => 'App\Entity\Instrument','choice_label' => 'nom' ))
            ->add('Professionnel', EntityType::class, array('class' => 'App\Entity\Professionnel','choice_label' => 'nom'))
            ->add('DateDebut',DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('DateFin',DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('Descriptif', TextType::class, [
                'constraints' => [
                    new Length([
                        'min' => 10,
                        'max' => 100,
                        'minMessage' => 'La description doit contenir au moins {{ limit }} caractères.',
                        'maxMessage' => 'La description ne peut pas dépasser {{ limit }} caractères.',
                    ]),
                    new Regex([
                        'pattern' => '/^[A-Za-z0-9\s]+$/',
                        'message' => 'Seules les lettres, les chiffres et les espaces sont autorisés.',
                    ]),

                ],
            ])

            ->add('Prix', NumberType::class, [
                'constraints' => [
                    new GreaterThanOrEqual([
                        'value' => 0,
                        'message' => 'Le prix ne peut pas être négatif.',
                    ]),
                ],
            ])

            ->add('enregistrer', SubmitType::class, array('label' => 'Nouvel intervention'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Intervention::class,
        ]);
    }
}
