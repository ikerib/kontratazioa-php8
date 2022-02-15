<?php

namespace App\Form;

use App\Entity\Fitxategia;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FitxategiaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('fileName')
            ->add('fileSize')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('fitxategiMota')
            ->add('kontratua')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Fitxategia::class,
        ]);
    }
}
