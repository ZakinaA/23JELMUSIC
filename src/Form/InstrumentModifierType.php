<?php

namespace App\Form;

use App\Entity\Instrument;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InstrumentModifierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numSerie', TextType::class)
            ->add('dateAchat', DateType::class)
            ->add('prixAchat', NumberType::class)
            ->add('utilisation', TextType::class)
            ->add('cheminImage', TextType::class)
            ->add('Nom', TextType::class)
            ->add('id_marque', EntityType::class, array('class' => 'App\Entity\Marque', 'choice_label' => 'libelle'))
            ->add('id_type', EntityType::class, array('class' => 'App\Entity\TypeInstrument', 'choice_label' => 'libelle'))
            ->add('enregistrer', SubmitType::class, array('label' => 'Modifier Instrument'));
        ;
    }

    public function getParent(){
        return InstrumentType::class;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Instrument::class,
        ]);
    }
}
