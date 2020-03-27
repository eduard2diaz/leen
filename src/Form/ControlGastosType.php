<?php

namespace App\Form;

use App\Entity\ControlGastos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ControlGastosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fechacaptura')
            ->add('concepto')
            ->add('numerocomprobante')
            ->add('monto')
            ->add('controlarchivos')
            ->add('proyecto')
            ->add('tipoComprobante')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ControlGastos::class,
        ]);
    }
}
