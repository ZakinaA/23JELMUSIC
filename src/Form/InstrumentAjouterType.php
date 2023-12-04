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
            ->add('nom', TextType::class)
            ->add('type', EntityType::class, array('class' => 'App\Entity\TypeInstrument', 'choice_label' => 'libelle'))
            ->add('marque', EntityType::class, array('class' => 'App\Entity\Marque', 'choice_label' => 'libelle'))
            ->add('utilisation', TextType::class)
            ->add('dateAchat', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('prixAchat', NumberType::class)
            ->add('numSerie', TextType::class)
            ->add('cheminImage', HiddenType::class)
            ->add('enregistrer', SubmitType::class, array('label' => 'Nouvel Instrument'));

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
