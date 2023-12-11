<?php

namespace App\Form;

use App\Entity\Eleve;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EleveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class,[
                'attr' => ['class' => 'mb-4 form-control'],
            ])
            ->add('prenom', TextType::class,[
                'attr' => ['class' => 'mb-4 form-control'],
            ])
            ->add('numRue', TextType::class,[
                'attr' => ['class' => 'mb-4 form-control'],
            ])
            ->add('rue', TextType::class,[
                'attr' => ['class' => 'mb-4 form-control'],
            ])
            ->add('copos', TextType::class,[
                'attr' => ['class' => 'mb-4 form-control'],
            ])
            ->add('ville', TextType::class,[
                'attr' => ['class' => 'mb-4 form-control'],
            ])
            ->add('tel', TextType::class,[
                'attr' => ['class' => 'mb-4 form-control'],
            ])
            ->add('mail', TextType::class,[
                'attr' => ['class' => 'mb-4 form-control'],
            ])
            ->add('responsables', EntityType::class, [
                'class' => 'App\Entity\Responsable',
                'choice_label' => function ($responsables) {
                    return $responsables->getNom() . ' ' . $responsables->getPrenom();
                },
                'attr' => ['class' => 'mb-4 form-control'],
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Créer un éleve',
                'attr' => ['class' => 'btn btn-primary m-1'],
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Eleve::class,
        ]);
    }
}
