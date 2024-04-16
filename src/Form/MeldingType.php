<?php
// src/Form/MeldingType.php

namespace App\Form;

use App\Entity\Melding;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MeldingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type_melding', ChoiceType::class, [
                'choices' => [
                    'Afval' => 'Afval',
                    'Verlichting' => 'Verlichting',
                ],
                'label' => 'Type Melding',
            ])
            ->add('inhoud', TextareaType::class, [
                'label' => 'Inhoud',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Melding::class,
        ]);
    }
}
?>