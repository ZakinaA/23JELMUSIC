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
            ->add('Descriptif', TextType::class)
            ->add('Prix', NumberType::class)
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
