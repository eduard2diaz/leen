<?php

namespace App\Form;

use App\Entity\RendicionCuentas;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RendicionCuentasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fechacaptura')
            ->add('monto')
            ->add('rendicionesarchivos')
            ->add('proyecto')
            ->add('tipoAccion')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RendicionCuentas::class,
        ]);
    }
}
