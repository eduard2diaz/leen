<?php

namespace App\Form;

use App\Entity\CodigoPostal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CodigoPostalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('d_Asenta')
            ->add('d_tipoasenta')
            ->add('d_mpio')
            ->add('d_estado')
            ->add('d_ciudad')
            ->add('d_cp')
            ->add('c_estado')
            ->add('c_CP')
            ->add('c_tipoasenta')
            ->add('c_municipio')
            ->add('id_asenta_cpcons')
            ->add('d_zona')
            ->add('c_cve_ciudad')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CodigoPostal::class,
        ]);
    }
}
