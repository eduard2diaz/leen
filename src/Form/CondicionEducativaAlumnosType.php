<?php

namespace App\Form;

use App\Entity\CondicionEducativaAlumnos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CondicionEducativaAlumnosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ccts',TextType::class,['label'=>'Ccts','attr'=>['class'=>'form-control']])
            ->add('numalumnas',IntegerType::class,['label'=>'Número de alumnas','attr'=>['class'=>'form-control']])
            ->add('numalumnos',IntegerType::class,['label'=>'Número de alumnos','attr'=>['class'=>'form-control']])
            ->add('grado')
            //->add('diagnostico')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CondicionEducativaAlumnos::class,
        ]);
    }
}
