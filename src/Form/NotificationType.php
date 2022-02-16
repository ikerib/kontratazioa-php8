<?php

namespace App\Form;

use App\Entity\KontratuaLote;
use App\Entity\Notification;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NotificationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user', EntityType::class, [
                'attr' => ['class' => 'form-control select2'],
                'class' => User::class,
                'label' => 'Nori',
                'placeholder' => 'Aukeratu bat'
            ])
            ->add('lote', EntityType::class, [
                'attr' => ['class' => 'form-control select2'],
                'class' => KontratuaLote::class,
                'placeholder' => 'Aukeratu bat'
            ])
            ->add('noiz', DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'attr' => [
                    'class' => 'datetimepicker col-2 col-sm-2',
                    'autocomplete' => 'off'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Notification::class,
        ]);
    }
}
