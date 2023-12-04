<?php

namespace App\Form;

use App\Entity\ContratPret;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Regex;

class ContratPretType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('eleve',EntityType::class, array('class' => 'App\Entity\Eleve','choice_label' => 'nom' ))
            ->add('Instrument',EntityType::class, array ('class' => 'App\Entity\Instrument','choice_label' => 'nom' ))
            ->add('dateDebut',DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',

            ])
            ->add('dateFin',DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'required' => false,
            ])
            ->add('attestationAssurance', TextType::class, [
                'required' => false,
            ])
            ->add('etatDetailleDebut', TextType::class, [
                'constraints' => [
                    new Length([
                        'min' => 4,
                        'max' => 50,
                        'minMessage' => 'La description doit contenir au moins {{ limit }} caractères.',
                        'maxMessage' => 'La description ne peut pas dépasser {{ limit }} caractères.',
                    ]),
                    new Regex([
                        'pattern' => '/^[A-Za-zÀ-ÖØ-öø-ÿ0-9\s]+$/u',
                        'message' => 'Seules les lettres, les chiffres et les espaces sont autorisés.',
                    ]),

                ],
            ])
            ->add('etatDetailleRetour',TextType::class, [
                'constraints' => [
                    new Length([
                        'max' => 50,
                        'maxMessage' => 'La description ne peut pas dépasser {{ limit }} caractères.',
                    ]),
                    new Regex([
                        'pattern' => '/^[A-Za-zÀ-ÖØ-öø-ÿ0-9\s]+$/u',
                        'message' => 'Seules les lettres, les chiffres et les espaces sont autorisés.',
                    ]),

                ],
                'required' => false,
            ])


            ->add('enregistrer', SubmitType::class, array('label' => 'Ajout du prêt'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContratPret::class,
        ]);
    }
}
