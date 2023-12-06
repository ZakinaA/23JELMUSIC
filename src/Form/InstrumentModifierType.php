<?php

namespace App\Form;

use App\Entity\Instrument;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InstrumentModifierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => ['class' => 'mb-4 form-control'],
            ])
            ->add('type', EntityType::class,[
                'class' => 'App\Entity\TypeInstrument',
                'choice_label' => 'libelle',
                'attr' => ['class' => 'mb-4 form-control'],
                ])
            ->add('marque', EntityType::class, [
                'class' => 'App\Entity\Marque',
                'choice_label' => 'libelle',
                'attr' => ['class' => 'mb-4 form-control'],
                ])
            ->add('utilisation', TextType::class, [
                'attr' => ['class' => 'mb-4 form-control'],
            ])
            ->add('dateAchat', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'attr' => ['class' => 'mb-4 form-control'],
            ])
            ->add('prixAchat', NumberType::class, [
                'attr' => ['class' => 'mb-4 form-control'],
            ])
            ->add('numSerie', TextType::class, [
                'attr' => ['class' => 'mb-4 form-control'],
            ])
            ->add('enregistrer', SubmitType::class, [
                'label' => 'Modification Instrument',
                'attr' => ['class' => 'btn btn-primary'],
            ]);

    }

    public function getParent(){
        return InstrumentAjouterType::class;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Instrument::class,
        ]);
    }
}
