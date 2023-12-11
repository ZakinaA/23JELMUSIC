<?php

namespace App\Form;

use App\Entity\Instrument;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class InstrumentAjouterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => ['class' => 'mb-4 form-control'],
            ])
            ->add('type', EntityType::class, [
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
            ->add('cheminImage', HiddenType::class, [
                'attr' => ['class' => 'mb-4 form-control'],
            ])
            ->add('couleurs')
            ->add('enregistrer', SubmitType::class, [
                'label' => 'Nouvel Instrument',
                'attr' => ['class' => 'btn btn-primary'],
            ]);

        $builder->addEventListener(FormEvents::PRE_SUBMIT, [$this, 'onPreSubmit']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Instrument::class,
        ]);
    }

    public function onPreSubmit(FormEvent $event)
    {
        $data = $event->getData();
        $data['cheminImage'] = '/img' . $data['cheminImage'];
        $event->setData($data);
    }
}
