<?php

namespace App\Form;

use App\Entity\Fitxategia;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyPath;
use Vich\UploaderBundle\Form\Type\VichFileType;

class FitxategiaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null,[
                'label' => 'Deskribapena: ',
                'required' => true
            ])
            ->add('fitxategimota', null, [
                'label' => 'Fitxategi Mota',
                'attr' => ['class' => 'form-control select2'],
                'placeholder' => 'Aukeratu bat',
                'required' => true
            ])
            ->add('uploadFile', VichFileType::class, [
                'label' => 'Fitxategia:',
                'required' => false,
                'allow_delete' => true,
                'delete_label' => 'Ezabatu fitxategia',
                'asset_helper' => true,
                'download_label' => 'Deskargatu fitxategia'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Fitxategia::class,
            'block_prefix' => 'fitxategia_upload'
        ]);
    }
}
