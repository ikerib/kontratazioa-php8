<?php

namespace App\Form;

use App\Entity\Kontratua;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KontratuaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('espedientea')
            ->add('izena_eus')
            ->add('izena_es')
            ->add('oharrak')
            ->add('espedienteElektronikoa')
            ->add('artxiboa')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('arduraduna')
            ->add('egoera')
            ->add('mota')
            ->add('prozedura')
            ->add('saila')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Kontratua::class,
        ]);
    }
}
