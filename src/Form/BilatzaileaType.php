<?php

namespace App\Form;

use App\Entity\Egoera;
use App\Entity\Kontratista;
use App\Entity\KontratuaLote;
use App\Entity\Saila;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BilatzaileaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Izena'
            ])
            ->add('kontratista', EntityType::class, [
                'class' => Kontratista::class,
                'choice_value' => 'id',
                'attr' => ['class' => 'form-control select2'],
                'placeholder' => 'Aukeratu bat'
            ])
            ->add('saila', EntityType::class, [
                'class' => Saila::class,
                'attr' => ['class' => 'form-control select2'],
                'placeholder' => 'Aukeratu bat',
                'mapped' => false
            ])
            ->add('egoera', EntityType::class, [
                'class' => Egoera::class,
                'attr' => ['class' => 'form-control select2'],
                'placeholder' => 'Aukeratu bat',
                'mapped' => false
            ])
//            ->add('isFixed', null, [
//                'label' => 'Zuzenduta'
//            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => KontratuaLote::class,
            'csrf_protection' => false
        ]);
    }
}
