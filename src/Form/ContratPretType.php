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

class ContratPretType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Instrument',EntityType::class, array ('class' => 'App\Entity\Instrument','choice_label' => 'nom' ))
            ->add('dateDebut',DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('dateFin',DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('attestationAssurance',TextType::class)
            ->add('etatDetailleDebut', TextType::class)
            ->add('etatDetailleRetour',TextType::class)
            ->add('eleve',EntityType::class, array('class' => 'App\Entity\Eleve','choice_label' => 'nom' ))

            ->add('enregistrer', SubmitType::class, array('label' => 'Nouvel étudiant'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContratPret::class,
        ]);
    }
}
