<?php

namespace App\Form;

use App\Entity\Kontaktuak;
use App\Entity\Saila;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KontaktuakType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('email')
            ->add('saila', EntityType::class, [
                'attr' => ['class' => 'form-control select2'],
                'class' => Saila::class,
                'placeholder' => 'Aukeratu bat'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Kontaktuak::class,
        ]);
    }
}
