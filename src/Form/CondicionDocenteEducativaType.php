<?php

namespace App\Form;

use App\Entity\CondicionDocenteEducativa;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CondicionDocenteEducativaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ccts',TextType::class,['attr'=>['class'=>'form-control']])
            ->add('curp',TextType::class,['attr'=>['class'=>'form-control']])
            ->add('nombre',TextType::class,['attr'=>['class'=>'form-control']])
            ->add('grado',TextType::class,['attr'=>['class'=>'form-control']])
           // ->add('diagnostico')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CondicionDocenteEducativa::class,
        ]);
    }
}
