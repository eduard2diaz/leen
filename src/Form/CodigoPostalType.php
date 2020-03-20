<?php

namespace App\Form;

use App\Entity\CodigoPostal;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CodigoPostalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('d_Asenta',TextType::class,['attr'=>['class'=>'form-control']])
            ->add('d_tipoasenta',TextType::class,['attr'=>['class'=>'form-control']])
            ->add('c_tipoasenta',IntegerType::class,['attr'=>['class'=>'form-control']])

            ->add('d_mpio',TextType::class,['attr'=>['class'=>'form-control']])
            ->add('c_municipio',TextType::class,['attr'=>['class'=>'form-control']])

            ->add('d_estado',TextType::class,['attr'=>['class'=>'form-control']])
            ->add('c_estado',TextType::class,['attr'=>['class'=>'form-control']])

            ->add('d_ciudad',TextType::class,['attr'=>['class'=>'form-control']])

            ->add('d_cp',IntegerType::class,['attr'=>['class'=>'form-control']])
            ->add('c_CP',TextType::class,['attr'=>['class'=>'form-control']])


            ->add('id_asenta_cpcons',TextType::class,['attr'=>['class'=>'form-control']])
            ->add('d_zona',TextType::class,['attr'=>['class'=>'form-control']])
            ->add('c_cve_ciudad',TextType::class,['attr'=>['class'=>'form-control']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CodigoPostal::class,
        ]);
    }
}
