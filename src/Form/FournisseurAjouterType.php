<?php

namespace App\Form;

use App\Entity\Fournisseur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FournisseurAjouterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => ['class' => 'mb-4 form-control'],
            ])
            ->add('adresse', TextType::class, [
                'attr' => ['class' => 'mb-4 form-control'],
            ])
            ->add('telephone', NumberType::class, [
                'attr' => ['class' => 'mb-4 form-control'],
            ])
            ->add('mail', TextType::class, [
                'attr' => ['class' => 'mb-4 form-control'],
            ])
            ->add('contact', TextType::class, [
                'attr' => ['class' => 'mb-4 form-control'],
            ])
            ->add('enregistrer', SubmitType::class, [
                'label' => 'Nouvel Fournisseur',
                'attr' => ['class' => 'btn btn-primary'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Fournisseur::class,
        ]);
    }
}
