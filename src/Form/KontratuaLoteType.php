<?php

namespace App\Form;

use App\Entity\KontratuaLote;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KontratuaLoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('zenbatekoarenUnitatea')
            ->add('aurrekontuaIva')
            ->add('aurrekontuaIvaGabe')
            ->add('sinadura')
            ->add('iraupena')
            ->add('fetxaIraupena')
            ->add('adjudikazioaIva')
            ->add('adjudikazioaIvaGabe')
            ->add('luzapena')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('kontratua')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => KontratuaLote::class,
        ]);
    }
}
