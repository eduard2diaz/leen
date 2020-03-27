<?php

namespace App\Form;

use App\Entity\CondicionDocenteEducativa;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CondicionDocenteEducativaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ccts')
            ->add('curp')
            ->add('nombre')
            ->add('grado')
            ->add('diagnostico')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CondicionDocenteEducativa::class,
        ]);
    }
}
