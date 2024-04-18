<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Melding;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MeldingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categorie', EntityType::class, [
               'class' => Categorie::class,
                'label' => 'Type Melding',
                'choice_label' => 'naam'
            ])
            ->add('inhoud', TextareaType::class, [
                'label' => 'Inhoud',
            ])
            ->add('afbeelding', FileType::class, [
                'label' => 'Afbeelding toevoegen',
                'required' => false,
                'mapped' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Melding::class,
        ]);
    }
}
