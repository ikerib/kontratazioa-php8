<?php

namespace App\Form;

use App\Entity\Arduraduna;
use App\Entity\Egoera;
use App\Entity\Kontratista;
use App\Entity\Kontratua;
use App\Entity\Mota;
use App\Entity\Prozedura;
use App\Entity\Saila;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class KontratuaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('espedientea', null, [
                'attr' => [
                    'autocomplete' => 'off'
                ]
            ])
            ->add('izena_eus', null, [
                'attr' => [
                    'autocomplete' => 'off'
                ]
            ])
            ->add('izena_es', null, [
                'attr' => [
                    'autocomplete' => 'off'
                ]
            ])
            ->add('artxiboa', null, [
                'attr' => [
                    'autocomplete' => 'off'
                ]
            ])
            ->add('espedienteElektronikoa', null, [
                'label_attr' => ['class' => 'col-sm-4'],
                'attr' => [
                    'autocomplete' => 'off'
                ]
            ])

            ->add('mota', EntityType::class, [
                'attr' => ['class' => 'form-control select2'],
                'class' => Mota::class,
                'placeholder' => 'Aukeratu bat'
            ])
            ->add('arduraduna', EntityType::class, [
                'attr' => ['class' => 'form-control select2'],
                'class' => Arduraduna::class,
                'placeholder' => 'Aukeratu bat'
            ])
            ->add('oharrak', CKEditorType::class,[])
            ->add('prozedura', EntityType::class, [
                'attr' => ['class' => 'form-control select2'],
                'class' => Prozedura::class,
                'placeholder' => 'Aukeratu bat'
            ])
            ->add('saila', EntityType::class, [
                'attr' => ['class' => 'form-control select2'],
                'class' => Saila::class,
                'placeholder' => 'Aukeratu bat'
            ])
            ->add('egoera', EntityType::class, [
                'attr' => ['class' => 'form-control select2'],
                'class' => Egoera::class,
                'placeholder' => 'Aukeratu bat'
            ])
//            ->add ('fitxategiak', CollectionType::class, [
//                'entry_type' => FitxategiaType::class,
//                'allow_add' => true,
//                'allow_delete' => true,
//                'prototype' => true
//            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Kontratua::class,
        ]);
    }
}


